<?php

use Illuminate\Support\Facades\Process;

/**
 * Runs once Penang is installed (Statamic's starter kit post-install hook).
 * It only adds: the Marketing Toolkit's tables, the asset library's and
 * the site search's indexes,
 * and, if you agree, the removal of the two placeholder files a new Statamic
 * site has in public/, which would hide the toolkit's robots.txt and icons.
 *
 * Each command runs as its own `php artisan`: the installer's process started
 * before the kit's packages were installed, so it doesn't know them.
 */
class StarterKitPostInstall
{
    public function handle($console)
    {
        $console->line('');
        $console->info('Setting up Penang…');

        $this->artisan($console, ['migrate', '--force'], 'Marketing Toolkit tables (php artisan migrate)');
        $this->restoreAssetMeta($console);
        $this->artisan($console, ['statamic:assets:meta', 'assets'], 'Asset library (php please assets:meta)');
        $this->artisan($console, ['statamic:stache:clear'], 'Content index (php please stache:clear)');
        $this->artisan($console, ['statamic:search:update', '--all'], 'Site search (php please search:update)');

        $placeholders = array_filter(
            [public_path('robots.txt'), public_path('favicon.ico')],
            fn ($path) => is_file($path) && filesize($path) < 200,
        );
        if ($placeholders && $console->confirm('Remove the empty public/robots.txt and public/favicon.ico, so the Marketing Toolkit serves its own?', true)) {
            array_map('unlink', $placeholders);
            $console->line('  ✓ Removed '.implode(' and ', array_map('basename', $placeholders)));
        }

        $console->line('');
        $console->info('Penang is installed. Next:');
        $console->line('  1. Create your user (Statamic Core has one): php please make:user --super');
        $console->line('  2. Set APP_URL in .env to the site’s address.');
        $console->line('  3. Open /cp: replace Kopi Lane Roasters under Marketing → Brand, Globals → Site settings and Globals → Theme.');
        $console->line('  4. See every section in your theme at /components.');
        $console->line('');
        $console->line('  The guide for the people who will edit the site is docs/user-manual.md.');
        $console->line('  After changing templates or styles: npm install && npm run build');
        $console->line('');
    }

    /**
     * The sample pictures' alt text and focal points. Statamic keeps them in
     * hidden .meta folders, which the installer doesn't copy, so the kit
     * ships them in resources/asset-meta; they go back where Statamic looks.
     */
    private function restoreAssetMeta($console): void
    {
        $staged = resource_path('asset-meta');
        if (! is_dir($staged)) {
            return;
        }

        foreach (glob("{$staged}/*/*.yaml") as $file) {
            $folder = public_path('assets/'.basename(dirname($file)).'/.meta');
            if (! is_dir($folder)) {
                mkdir($folder, 0755, true);
            }
            if (! is_file($target = $folder.'/'.basename($file))) {
                copy($file, $target);
            }
            unlink($file);
        }
        array_map('rmdir', glob("{$staged}/*", GLOB_ONLYDIR));
        rmdir($staged);

        $console->line('  ✓ Alt text of the sample pictures');
    }

    private function artisan($console, array $command, string $done): void
    {
        $result = Process::path(base_path())->timeout(300)->run([PHP_BINARY, 'artisan', ...$command]);

        if ($result->successful()) {
            $console->line("  ✓ {$done}");

            return;
        }

        $console->warn("  ✗ {$done} did not finish. Run it yourself: php artisan ".implode(' ', $command));
        $console->line(trim($result->errorOutput() ?: $result->output()));
    }
}
