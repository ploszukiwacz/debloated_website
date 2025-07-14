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

class Header {
    private $subtitle;
    private $showNav;
    private $navLinks;
    
    public function __construct($subtitle = '', $showNav = true) {
        $this->subtitle = $subtitle;
        $this->showNav = $showNav;
        $this->setupNavLinks();
    }
    
    private function setupNavLinks() {
        $this->navLinks = [
            Link::nav('/', 'Home'),
            Link::nav('/privacy.php', 'Privacy Policy'),
            Link::nav('https://blog.ploszukiwacz.is-a.dev', 'Blog', ['title' => 'My blog'])
        ];
    }
    
    public function render() {
        $html = "  <header>\n";
        $html .= "   <h1>PlOszukiwacz</h1>\n";
        
        if (!empty($this->subtitle)) {
            $html .= "   <p>" . htmlspecialchars($this->subtitle) . "</p>\n";
        }
        
        if ($this->showNav) {
            $html .= "   <nav>\n";
            $html .= "    ";
            
            $linkStrings = [];
            foreach ($this->navLinks as $link) {
                $linkStrings[] = $link->render();
            }
            
            $html .= implode(' / ', $linkStrings);
            $html .= "\n   </nav>\n";
        }
        
        $html .= "  </header>\n";
        
        return $html;
    }
    
    public function addNavLink($url, $text, $options = []) {
        $this->navLinks[] = Link::nav($url, $text, $options);
        return $this;
    }
    
    public function setNavLinks($links) {
        $this->navLinks = $links;
        return $this;
    }
}
?>