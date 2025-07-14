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

class Footer {
    private $year;
    private $name;
    private $fontInfo;
    
    public function __construct($options = []) {
        $this->year = $options['year'] ?? date('Y');
        $this->name = $options['name'] ?? 'PlOszukiwacz';
        $this->setupFontInfo();
    }
    
    private function setupFontInfo() {
        $this->fontInfo = [
            'name' => 'Maple Mono',
            'url' => 'https://github.com/subframe7536/maple-font',
            'author' => 'subframe7536',
            'author_url' => 'https://github.com/subframe7536/'
        ];
    }
    
    public function render() {
        $fontLink = Link::social($this->fontInfo['url'], $this->fontInfo['name']);
        $authorLink = Link::social($this->fontInfo['author_url'], $this->fontInfo['author']);
        
        $html = "  <footer>\n";
        $html .= "   <p>";
        $html .= "© " . htmlspecialchars($this->year) . " | ";
        $html .= htmlspecialchars($this->name) . " | ";
        $html .= "Font: " . $fontLink->render() . " by " . $authorLink->render();
        $html .= "</p>\n";
        $html .= "  </footer>\n";
        
        return $html;
    }
    
    public function setYear($year) {
        $this->year = $year;
        return $this;
    }
    
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    
    public function setFontInfo($name, $url, $author, $authorUrl) {
        $this->fontInfo = [
            'name' => $name,
            'url' => $url,
            'author' => $author,
            'author_url' => $authorUrl
        ];
        return $this;
    }
}
?>