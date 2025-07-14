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

class Link {
    private $url;
    private $text;
    private $attributes;
    
    public function __construct($url, $text, $options = []) {
        $this->url = $url;
        $this->text = $text;
        $this->attributes = [];
        
        // Process options
        $this->processOptions($options);
    }
    
    private function processOptions($options) {
        // Default attributes
        $defaults = [
            'class' => '',
            'target' => '',
            'rel' => '',
            'title' => ''
        ];
        
        $options = array_merge($defaults, $options);
        
        // Auto-detect external links
        if ($this->isExternal($this->url)) {
            $options['target'] = '_blank';
            $options['rel'] = 'nofollow';
        }
        
        // Special handling for different link types
        if (isset($options['type'])) {
            switch ($options['type']) {
                case 'nav':
                    // Navigation links
                    break;
                case 'contact':
                    // Contact links
                    $options['rel'] = 'nofollow';
                    break;
                case 'social':
                    // Social media links
                    $options['target'] = '_blank';
                    $options['rel'] = 'nofollow';
                    break;
                case 'project':
                    // Project links
                    $options['target'] = '_blank';
                    break;
            }
        }
        
        // Set attributes
        foreach ($options as $key => $value) {
            if ($key !== 'type' && !empty($value)) {
                $this->attributes[$key] = $value;
            }
        }
    }
    
    private function isExternal($url) {
        return (
            strpos($url, 'http://') === 0 || 
            strpos($url, 'https://') === 0 || 
            strpos($url, '//') === 0
        );
    }
    
    public function render() {
        $attributeString = '';
        foreach ($this->attributes as $key => $value) {
            $attributeString .= sprintf(' %s="%s"', $key, htmlspecialchars($value));
        }
        
        return sprintf(
            '<a href="%s"%s>%s</a>',
            htmlspecialchars($this->url),
            $attributeString,
            htmlspecialchars($this->text)
        );
    }
    
    public function __toString() {
        return $this->render();
    }
    
    // Static helper methods for common link types
    public static function nav($url, $text, $options = []) {
        $options['type'] = 'nav';
        return new self($url, $text, $options);
    }
    
    public static function social($url, $text, $options = []) {
        $options['type'] = 'social';
        return new self($url, $text, $options);
    }
    
    public static function contact($url, $text, $options = []) {
        $options['type'] = 'contact';
        return new self($url, $text, $options);
    }
    
    public static function project($url, $text, $options = []) {
        $options['type'] = 'project';
        return new self($url, $text, $options);
    }
    
    public static function email($email, $text = null, $options = []) {
        $text = $text ?: $email;
        $options['type'] = 'contact';
        return new self("mailto:$email", $text, $options);
    }
}
?>