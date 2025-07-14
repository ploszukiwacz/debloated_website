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

require_once 'autoload.php';

// Create page instance for 404 error
$page = Page::error404();

// Create 404 error content
$errorContent = function() {
    $html = "  <section class=\"error-container\">\n";
    $html .= "   <div class=\"error-code\">404</div>\n";
    $html .= "   <div class=\"error-message\">Page Not Found</div>\n";
    $html .= "   <div class=\"error-description\">\n";
    $html .= "    Oops! The page you're looking for seems to have vanished into the digital void.\n";
    $html .= "    It might have been moved, deleted, or maybe it never existed in the first place.\n";
    $html .= "   </div>\n";
    
    // Create home button link
    $homeLink = Link::nav('/', 'Take Me Home', ['class' => 'home-button']);
    $html .= "   " . $homeLink->render() . "\n";
    
    $html .= "  </section>\n";
    
    return $html;
};

// Render the complete page
echo $page->renderComplete($errorContent());
?>