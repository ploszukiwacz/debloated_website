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
$page = Page::privacy();

// Create privacy content
$privacyContent = function() {
    $html = "  <section class=\"container privacy-content\">\n";
    $html .= "   <h1>Privacy Policy</h1>\n";
    $html .= "   <p class=\"last-updated\">Last updated: July 2025</p>\n\n";

    $html .= "   <h2>Introduction</h2>\n";
    $html .= "   <p>\n";
    $html .= "    This privacy policy explains how PlOszukiwacz (\"I\", \"me\", or \"my\") collects, uses, and protects\n";
    $html .= "    information when you visit my personal website at ploszukiwacz.is-a.dev (the \"Service\").\n";
    $html .= "   </p>\n\n";

    $html .= "   <h2>Information Collection</h2>\n";
    $html .= "   <h3>Server Logs</h3>\n";
    $html .= "   <p>\n";
    $html .= "    Whenever you access this webserver running nginx, a line in the server's log file is printed\n";
    $html .= "    and contains the following data sent by your browser:\n";
    $html .= "   </p>\n";
    $html .= "   <ul>\n";
    
    $logData = [
        'IP address',
        'Time of request sent',
        'Type of request',
        'Result of request',
        'Location of requested resource',
        'Referer (Website that hyperlinks to this one)',
        'UserAgent (Version and type of web browser and often operating system version)'
    ];
    
    foreach ($logData as $item) {
        $html .= "    <li>" . htmlspecialchars($item) . "</li>\n";
    }
    
    $html .= "   </ul>\n";
    $html .= "   <p>\n";
    $html .= "    This website does not collect any more data than nginx collects by default (specified above).\n";
    $html .= "   </p>\n\n";

    $html .= "   <h3>External Services</h3>\n";
    $html .= "   <p>This website uses the following external services that may collect additional data:</p>\n";
    $html .= "   <ul>\n";
    $html .= "    <li><strong>GitHub Stats API (github-readme-stats.vercel.app):</strong> Displays my GitHub statistics. Please refer to GitHub's and Vercel's privacy policies for information about their data collection practices.</li>\n";
    $html .= "   </ul>\n\n";

    $html .= "   <h2>Use of Information</h2>\n\n";
    
    $html .= "   <h3>Why We Keep Logs</h3>\n";
    $html .= "   <p>\n";
    $html .= "    We collect logs so we can prevent and examine possible threats to our network\n";
    $html .= "    (such as spam and DDoS attacks).\n";
    $html .= "   </p>\n\n";
    
    $html .= "   <h3>How We Analyze</h3>\n";
    $html .= "   <p>\n";
    $html .= "    Traffic analysis is performed by a tool called Webalizer on log files with the data\n";
    $html .= "    specified above. The results of analysis are shared with no one and stored locally\n";
    $html .= "    on servers we own.\n";
    $html .= "   </p>\n\n";
    
    $html .= "   <h3>Why We Analyze</h3>\n";
    $html .= "   <p>\n";
    $html .= "    Analysis is an invaluable resource to us as it allows us to see which pages and\n";
    $html .= "    resources are the most viewed and utilized. It is used to provide insight so we\n";
    $html .= "    can create the most useful information for you and other site users.\n";
    $html .= "   </p>\n\n";
    
    $html .= "   <p>Additional uses of collected information include:</p>\n";
    $html .= "   <ul>\n";
    
    $additionalUses = [
        'Monitoring website performance and usage',
        'Identifying and fixing technical issues',
        'Understanding visitor preferences to improve the website',
        'Security purposes and preventing abuse'
    ];
    
    foreach ($additionalUses as $use) {
        $html .= "    <li>" . htmlspecialchars($use) . "</li>\n";
    }
    
    $html .= "   </ul>\n\n";

    $html .= "   <h2>Data Sharing</h2>\n";
    $html .= "   <p>\n";
    $html .= "    I do not sell, trade, or otherwise transfer your personal information to third parties, except:\n";
    $html .= "   </p>\n";
    $html .= "   <ul>\n";
    $html .= "    <li>When required by law</li>\n";
    $html .= "    <li>To protect my rights or safety</li>\n";
    $html .= "    <li>With service providers (like hosting services) who assist in operating the website</li>\n";
    $html .= "   </ul>\n\n";

    $html .= "   <h2>Cookies</h2>\n";
    $html .= "   <p>\n";
    $html .= "    This website does not use cookies or similar tracking technologies. However, external services\n";
    $html .= "    embedded in the site may use their own cookies according to their respective privacy policies.\n";
    $html .= "   </p>\n\n";

    $html .= "   <h2>Data Retention</h2>\n";
    $html .= "   <p>\n";
    $html .= "    Server logs are retained for a reasonable period for security and operational purposes.\n";
    $html .= "    Personal information is not stored longer than necessary.\n";
    $html .= "   </p>\n\n";

    $html .= "   <h2>Your Rights</h2>\n\n";
    
    $html .= "   <h3>Can I Opt-Out?</h3>\n";
    $html .= "   <p>\n";
    $html .= "    Absolutely! Your data is your data and if you would like to have it excluded from\n";
    $html .= "    future logging (which in turn applies to analysis) please email\n";
    
    $emailLink = Link::email('admin@ploszukiwacz.is-a.dev');
    $html .= "    " . $emailLink->render() . "\n";
    $html .= "    with your IP address and we'll sort it out as fast as we can.\n";
    $html .= "   </p>\n\n";
    
    $html .= "   <p>You also have the right to:</p>\n";
    $html .= "   <ul>\n";
    
    $rights = [
        'Request information about data collected about you',
        'Request correction or deletion of your personal data',
        'Object to processing of your personal data'
    ];
    
    foreach ($rights as $right) {
        $html .= "    <li>" . htmlspecialchars($right) . "</li>\n";
    }
    
    $html .= "   </ul>\n\n";

    $html .= "   <h2>Security</h2>\n";
    $html .= "   <p>\n";
    $html .= "    I implement appropriate security measures to protect against unauthorized access, alteration,\n";
    $html .= "    disclosure, or destruction of personal information. However, no method of transmission over\n";
    $html .= "    the internet is 100% secure.\n";
    $html .= "   </p>\n\n";

    $html .= "   <h2>Children's Privacy</h2>\n";
    $html .= "   <p>\n";
    $html .= "    This website is not directed at children under 13 years of age, and I do not knowingly\n";
    $html .= "    collect personal information from children under 13.\n";
    $html .= "   </p>\n\n";

    $html .= "   <h2>Changes to This Policy</h2>\n";
    $html .= "   <p>\n";
    $html .= "    I may update this privacy policy from time to time. Changes will be posted on this page\n";
    $html .= "    with an updated \"Last updated\" date.\n";
    $html .= "   </p>\n\n";

    $html .= "   <h2>Contact Information</h2>\n";
    $html .= "   <p>\n";
    $html .= "    If you have any questions about this privacy policy or your personal data, you can contact me at:\n";
    $html .= "   </p>\n";
    $html .= "   <ul>\n";
    
    $emailLink = Link::email('admin@ploszukiwacz.is-a.dev');
    $matrixLink = Link::social('https://matrix.to/#/@ploszukiwacz:matrix.org', '@ploszukiwacz:matrix.org');
    
    $html .= "    <li>Email: " . $emailLink->render() . "</li>\n";
    $html .= "    <li>Matrix: " . $matrixLink->render() . "</li>\n";
    $html .= "   </ul>\n\n";

    $html .= "   <h2>Governing Law</h2>\n";
    $html .= "   <p>\n";
    $html .= "    This privacy policy is governed by applicable privacy laws and regulations.\n";
    $html .= "   </p>\n";
    $html .= "  </section>\n";
    
    return $html;
};

// Render the complete page
echo $page->renderComplete($privacyContent());
?>