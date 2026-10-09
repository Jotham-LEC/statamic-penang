<?php

return [

    /*
     * Lets every visitor try the theme presets and settings with the theme
     * switcher, each in their own browser (a cookie), without changing the
     * Theme global. For a demo site. Signed-in control panel users can always
     * preview, on any site.
     */
    'theme_preview' => (bool) env('PENANG_THEME_PREVIEW', false),

];
