<?php

return [

    /*
     * Lets every visitor try the theme presets and settings with the theme
     * switcher, each in their own browser (a cookie), without changing the
     * Theme global. For a demo site. Signed-in control panel users can always
     * preview, on any site.
     */
    'theme_preview' => (bool) env('PENANG_THEME_PREVIEW', false),

    /*
     * With Laravel Boost installed, Penang's read-only tools join Boost's MCP
     * server for AI coding agents: penang-theme-check (a preset's contrast and
     * colours) and penang-sections (the page builder's sections). Set to false
     * to leave them out.
     */
    'boost_tools' => true,

];
