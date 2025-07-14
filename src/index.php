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

// Create page instance
$page = Page::home();

// Create content sections
$skillsSection = function() {
    $html = "  <section id=\"skills\">\n";
    $html .= "   <div class=\"skills-container\">\n";
    
    // Languages skill box
    $html .= "   <div class=\"skill\">\n";
    $html .= "    <h3>Languages</h3>\n";
    $html .= "    <ul>\n";
    $languages = ['Golang', 'Python', 'C', 'JavaScript', 'PHP'];
    foreach ($languages as $lang) {
        $html .= "     <li>" . htmlspecialchars($lang) . "</li>\n";
    }
    $html .= "    </ul>\n";
    $html .= "   </div>\n";
    
    // Tools & Technologies skill box
    $html .= "   <div class=\"skill\">\n";
    $html .= "    <h3>Tools & Technologies</h3>\n";
    $html .= "    <ul>\n";
    $tools = ['Node.js', 'Docker', 'Git', 'Astro'];
    foreach ($tools as $tool) {
        $html .= "     <li>" . htmlspecialchars($tool) . "</li>\n";
    }
    $html .= "    </ul>\n";
    $html .= "   </div>\n";
    
    // GitHub Stats skill box
    $html .= "   <div class=\"skill\">\n";
    $html .= "    <h3>Github Stats</h3>\n";
    $html .= "    <img src=\"https://github-readme-stats.vercel.app/api?username=ploszukiwacz&theme=catppuccin_mocha&show_icons=true&hide_border=true&count_private=false\" alt=\"Github Stats\" />\n";
    $html .= "   </div>\n";
    
    $html .= "   </div>\n";
    $html .= "  </section>\n";
    
    return $html;
};

$projectsSection = function() {
    $html = "  <section id=\"projects\">\n";
    $html .= "   <h2>My \"Best\" Projects</h2>\n";
    $html .= "   <ul>\n";
    
    // Create project links
    $projects = [
        [
            'url' => 'https://github.com/ploszukiwacz/femboyOS',
            'name' => 'femboyOS',
            'description' => 'Simple CLI OS.'
        ],
        [
            'url' => 'https://github.com/ploszukiwacz/femboySocial',
            'name' => 'femboySocial',
            'description' => 'Microblogging social media coded in PHP.'
        ],
        [
            'url' => '#',
            'name' => 'Radio Player',
            'description' => 'A simple web app to play radio.'
        ]
    ];
    
    foreach ($projects as $project) {
        $projectLink = Link::project($project['url'], $project['name']);
        $html .= "    <a href=\"" . htmlspecialchars($project['url']) . "\" target=\"_blank\">\n";
        $html .= "     <li><strong>" . htmlspecialchars($project['name']) . "</strong> - " . htmlspecialchars($project['description']) . "</li>\n";
        $html .= "    </a>\n";
    }
    
    $html .= "   </ul>\n";
    $html .= "  </section>\n";
    
    return $html;
};

$contactSection = function() {
    $html = "  <section id=\"contact\">\n";
    $html .= "   <p>Let's Connect</p>\n";
    $html .= "   <p>If you want to get in touch with me about something or just to say hi, reach out on social media or send me an email.</p>\n";
    $html .= "\n";
    $html .= "   <p>\n";
    
    // Create contact links
    $contacts = [
        Link::social('https://matrix.to/#/@ploszukiwacz:matrix.org', 'Matrix'),
        Link::social('https://twitter.com/ploszukiwacz', 'Twitter'),
        Link::social('https://github.com/ploszukiwacz', 'Github'),
        Link::email('admin@ploszukiwacz.is-a.dev', 'Email')
    ];
    
    $contactStrings = [];
    foreach ($contacts as $contact) {
        $contactStrings[] = '    <span class="contact-item">' . $contact->render() . '</span>';
    }
    
    $html .= implode(" /\n", $contactStrings);
    $html .= "\n   </p>\n";
    $html .= "  </section>\n";
    
    return $html;
};

// Build the complete page content
$content = $skillsSection() . "\n" . $projectsSection() . "\n" . $contactSection();

// Render the complete page
echo $page->renderComplete(
    $content,
    "I am a passionate developer focused on creating clean and efficient code."
);
?>