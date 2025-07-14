<?php
/*
Copyright (C) 2025 PlOszukiwacz

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

class Page {
    private $title;
    private $description;
    private $url;
    private $image;
    private $additionalMeta;
    private $stylesheets;
    
    public function __construct($title, $description = '', $options = []) {
        $this->title = $title;
        $this->description = $description ?: 'My new site :3';
        $this->url = $options['url'] ?? 'https://ploszukiwacz.is-a.dev';
        $this->image = $options['image'] ?? '/assets/android-chrome-192x192.png';
        $this->additionalMeta = $options['meta'] ?? [];
        $this->stylesheets = $options['stylesheets'] ?? ['styles.css'];
    }
    
    public function renderHead() {
        $html = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />

 <meta name="title" content="{$this->escapeHtml($this->title)}" />
 <meta name="description" content="{$this->escapeHtml($this->description)}" />

 <!-- Open Graph / Facebook -->
 <meta property="og:type" content="website" />
 <meta property="og:url" content="{$this->escapeHtml($this->url)}" />
 <meta property="og:title" content="{$this->escapeHtml($this->title)}" />
 <meta property="og:description" content="{$this->escapeHtml($this->description)}" />
 <meta property="og:image" content="{$this->escapeHtml($this->image)}" />

 <!-- Twitter -->
 <meta property="twitter:card" content="summary_large_image" />
 <meta property="twitter:url" content="{$this->escapeHtml($this->url)}" />
 <meta property="twitter:title" content="{$this->escapeHtml($this->title)}" />
 <meta property="twitter:description" content="{$this->escapeHtml($this->description)}" />
 <meta property="twitter:image" content="{$this->escapeHtml($this->image)}" />

 <!-- Favicons -->
 <link rel="apple-touch-icon" sizes="180x180" href="/assets/apple-touch-icon.png">
 <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon-32x32.png">
 <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon-16x16.png">
 <link rel="manifest" href="/assets/site.webmanifest">

HTML;

        // Additional meta tags
        foreach ($this->additionalMeta as $name => $content) {
            $html .= " <meta name=\"{$this->escapeHtml($name)}\" content=\"{$this->escapeHtml($content)}\" />\n";
        }

        $html .= "\n <title>{$this->escapeHtml($this->title)}</title>\n";

        // Stylesheets
        foreach ($this->stylesheets as $stylesheet) {
            $html .= " <link rel=\"stylesheet\" href=\"{$this->escapeHtml($stylesheet)}\">\n";
        }

        $html .= "</head>\n";
        
        return $html;
    }
    
    public function renderBodyStart() {
        return "<body>\n <div class=\"container\">\n";
    }
    
    public function renderBodyEnd() {
        return " </div>\n</body>\n</html>";
    }
    
    public function renderHeader($subtitle = '', $showNav = true) {
        $header = new Header($subtitle, $showNav);
        return $header->render();
    }
    
    public function renderFooter() {
        $footer = new Footer();
        return $footer->render();
    }
    
    public function renderComplete($content, $subtitle = '', $showNav = true) {
        return $this->renderHead() .
               $this->renderBodyStart() .
               $this->renderHeader($subtitle, $showNav) .
               $content .
               $this->renderFooter() .
               $this->renderBodyEnd();
    }
    
    private function escapeHtml($text) {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
    
    // Static helper methods for common page types
    public static function home() {
        return new self("PlOszukiwacz", "My new site :3", [
            'url' => 'https://ploszukiwacz.is-a.dev'
        ]);
    }
    
    public static function privacy() {
        return new self("Privacy Policy | PlOszukiwacz", "Privacy policy for PlOszukiwacz's personal website", [
            'url' => 'https://ploszukiwacz.is-a.dev/privacy.php'
        ]);
    }
    
    public static function error404() {
        return new self("404 - Page Not Found | PlOszukiwacz", "Oops! The page you're looking for doesn't exist.", [
            'url' => 'https://ploszukiwacz.is-a.dev/404'
        ]);
    }
}
?>