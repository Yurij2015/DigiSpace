INSERT INTO menu_items (id, menu_id, name, slug, href, created_at, updated_at)
VALUES (1, 1, 'About', 'about', 'about', '2023-02-08 17:25:58', '2023-02-08 17:25:58'),
       (2, 1, 'Services', 'services', 'services', '2023-02-08 17:25:58', '2023-02-08 17:25:58'),
       (3, 1, 'Pricing', 'pricing', 'pricing', '2023-02-08 17:25:58', '2023-02-08 17:25:58'),
       (4, 1, 'Promos', 'promos', 'promos', '2023-02-08 17:25:58', '2023-02-08 17:25:58'),
       (5, 1, 'Blog', 'blog', 'blog', '2023-02-08 17:25:58', '2023-02-08 17:25:58'),
       (6, 1, 'Pages', 'pages', 'pages', '2023-02-08 17:25:58', '2023-02-08 17:25:58'),
       (7, 1, 'Contact us', 'contact-us', 'contact-us', '2023-02-08 17:25:58', '2023-02-08 17:25:58'),
       (8, 2, 'Opening the Space of High Technologies', 'opening-the-space-of-high-technologies',
        'opening-the-space-of-high-technologies', '2023-02-08 17:25:58', '2023-06-11 20:55:54'),
       (9, 2, 'Top-Notch Analytics and Consulting on Web Development Technologies',
        'top-notch-analytics-and-consulting-on-web-development-technologies',
        'top-notch-analytics-and-consulting-on-web-development-technologies', '2023-02-08 17:25:58',
        '2023-06-12 06:44:28'),
       (10, 2, 'Template implementation', 'template-implementation', 'template-implementation', '2023-02-08 17:25:58',
        '2023-06-12 19:58:55'),
       (11, 2, 'Legacy code refactoring', 'legacy-code-refactoring', 'legacy-code-refactoring', '2023-02-08 17:25:58',
        '2023-06-12 20:54:10'),
       (12, 2, 'CRM and CMS Systems', 'crm-and-cms-systems', 'crm-and-cms-systems', '2023-02-08 17:25:58',
        '2023-06-12 21:58:49'),
       (13, 2, 'Web Applications', 'web-applications', 'web-applications', '2023-02-08 17:25:58',
        '2023-06-12 21:57:14'),
       (14, 4, 'Some Facts About DigiSpace',
        'meet-digispace-the-company-which-opens-a-new-era-in-the-web-development-industry',
        'meet-digispace-the-company-which-opens-a-new-era-in-the-web-development-industry', '2023-02-08 17:25:58',
        '2023-06-13 06:39:26'),
       (15, 2, 'QA & Testing', 'qa-testing', 'qa-testing', null, '2023-06-13 06:40:47'),
       (16, 2, 'Responsive Web Apps', 'responsive-web-apps', 'responsive-web-apps', null, '2023-06-13 06:23:41'),
       (17, 3, 'Opening Incredible Opportunities: PHP Is Our #1 Choice for Website Development',
        'opening-incredible-opportunities-php-is-our-1-choice-for-website-development',
        'opening-incredible-opportunities-php-is-our-1-choice-for-website-development', null, '2023-06-13 06:46:32'),
       (18, 3, 'MySQL Website Development—the Technology Which Became Legendary',
        'mysql-website-development-the-technology-which-became-legendary',
        'mysql-website-development-the-technology-which-became-legendary', '2023-06-12 22:57:23',
        '2023-06-13 06:56:45'),
       (19, 3, 'Websites and Apps Developed Using JavaScript Frameworks',
        'websites-and-apps-developed-using-javascript-frameworks',
        'websites-and-apps-developed-using-javascript-frameworks', null, '2023-06-13 07:02:34'),
       (20, 3, 'Host Your Website on Ubuntu Servers with DigiSpace!',
        'host-your-website-on-ubuntu-servers-with-digispace', 'host-your-website-on-ubuntu-servers-with-digispace',
        null, '2023-06-13 07:07:24')
ON DUPLICATE KEY UPDATE id         = VALUES(id),
                        menu_id    = VALUES(menu_id),
                        name       = VALUES(name),
                        slug       = VALUES(slug),
                        href       = VALUES(href),
                        created_at = VALUES(created_at),
                        updated_at = VALUES(updated_at);
