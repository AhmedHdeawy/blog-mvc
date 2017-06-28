-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 29, 2017 at 12:54 AM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `link` text NOT NULL,
  `image` text NOT NULL,
  `page` varchar(30) NOT NULL,
  `start_at` int(11) NOT NULL,
  `end_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `status`) VALUES
(2, 0, 'Math', 'disabled'),
(10, 0, 'Science', 'enabled'),
(11, 0, 'Web Development', 'enabled'),
(12, 0, 'CS', 'enabled'),
(13, 0, 'Web Design', 'enabled');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment`, `created`, `status`) VALUES
(1, 18, 6, 'Nice Article', 1498461029, 'enabled'),
(2, 18, 5, 'Awesome', 1498461074, 'enabled'),
(3, 18, 2, 'strong language', 1498461090, 'enabled'),
(4, 18, 4, 'it provide nice deign', 1498461136, 'enabled'),
(5, 18, 1, 'java is popular langugae', 1498461165, 'enabled'),
(6, 18, 1, 'Nice Post', 1498461671, 'enabled'),
(7, 18, 1, 'Great', 1498461692, 'enabled'),
(8, 18, 16, 'Nice Post', 1498619584, 'enabled'),
(9, 19, 12, 'Nice SHaring Icon', 1498631935, 'enabled');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(96) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `subject` varchar(96) NOT NULL,
  `message` text NOT NULL,
  `created` int(11) NOT NULL,
  `reply` text NOT NULL,
  `replied_by` int(11) NOT NULL,
  `replied_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `subject`, `message`, `created`, `reply`, `replied_by`, `replied_at`) VALUES
(1, 'Ahmed Hdeawy', 'ahmedhdeawy@gmail.com', '1142950885', 'Fix Bugs', 'Please check your website and search for issues in it and fix it, because your website is nice but it need to check every day, regards', 1498659920, '', 0, 0),
(2, 'Taha Ahmed', 'ahmedhdeawy@gmail.com', '1142950885', 'Security issues', 'Please check your website and search for issues in it and fix it, because your website is nice but it need to check every day, regards', 1498660000, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `online_users`
--

CREATE TABLE `online_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `image` text NOT NULL,
  `tags` text NOT NULL,
  `related_posts` text NOT NULL,
  `views` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `details`, `image`, `tags`, `related_posts`, `views`, `created`, `status`) VALUES
(1, 7, 11, 'Oracle Technology Network for Java Developers', '                                                                        &lt;p&gt;Java is a general-purpose computer programming language that is concurrent, class-based, object-oriented, and specifically designed to have as few Java is a general-purpose computer programming language that is concurrent, class-based, object-oriented, and specifically designed to have as few Java is a general-purpose computer programming language that is concurrent, class-based, object-oriented, and specifically designed to have as few&lt;/p&gt;\r\n                                                                ', '73d0908287c796a988aace154d171db90e1445f4_90b76acc141745822171d5c83a67d83fcb88d342.jpg', 'cs, java', '', 0, 1497803824, 'enabled'),
(2, 7, 10, 'C#', '                                    &lt;p&gt;Learn Csharp&lt;/p&gt;\r\n                                ', '778c02114e2ff2f79b9f02dae718dde1a099f69e_4881bed2134dc9c64664f49b5088641b14d39d54.jpg', 'cs, c#', '', 0, 1497803854, 'enabled'),
(3, 7, 11, 'PHP', '                                    &lt;p&gt;Learn PHP&lt;/p&gt;\r\n                                ', '0503edea5183cecfa8ba634e00ffcdda75d1b728_f5e4a68d0006c9eb72f9b9530668971aa8a33697.jpg', 'web, develop', '', 0, 1497803887, 'disabled'),
(4, 7, 11, 'CSS Cascading Style sheet Web Design', '                                                                                                                                                                                                                        &lt;p&gt;Cascading Style Sheets (CSS) are a stylesheet language used to describe the presentation of a document written in HTML or XML (including XML dialects like SVG or XHTML). CSS describes how elements should be rendered on screen, on paper, in speech, or on other media. Cascading Style Sheets (CSS) are a stylesheet language used to describe the presentation of a document written in HTML or XML (including XML dialects like SVG or XHTML). CSS describes how elements should be rendered on screen, on paper, in speech, or on other media. Cascading Style Sheets (CSS) are a stylesheet language used to describe the presentation of a document written in HTML or XML (including XML dialects like SVG or XHTML). CSS describes how elements should be rendered on screen, on paper, in speech, or on other media.&lt;/p&gt;\r\n                                                                                                                                                                                                ', '45f27efea1fdfa27f9a91fea12a2475f8141716c_b0413e5391330430df69c1802c3789018d0686dc.jpg', 'web, designs', '', 0, 1497839529, 'enabled'),
(5, 7, 11, 'Python is a general-purpose, multiparadigm, open source com‐ puter programming language', '&lt;p&gt;with support for object-oriented,&lt;br /&gt;\r\nfunctional, and procedural coding structures. It is commonly&lt;br /&gt;\r\nused both for standalone programs and for scripting applications&lt;br /&gt;\r\nin a wide variety of domains, and is generally considered to be&lt;br /&gt;\r\none of the most widely used programming languages in the&lt;br /&gt;\r\nworld.&lt;br /&gt;\r\nAmong Python&amp;rsquo;s features are an emphasis on code readability and&lt;br /&gt;\r\nlibrary functionality, and a design that optimizes developer pro‐&lt;br /&gt;\r\nductivity, software quality, program portability, and component&lt;br /&gt;\r\nintegration. Python programs run on most platforms in common&lt;br /&gt;\r\nuse, including Unix and Linux, Windows and Macintosh, Java&lt;br /&gt;\r\nand .NET, Android and iOS, and more.&lt;br /&gt;\r\n&amp;nbsp;&lt;/p&gt;\r\n', '99019baf2d1fec2a28b13a66edd8b78486c0052b_0dce390cc255a4e5281174f76f8ffc137d123939.jpg', 'programming, cs', '2,1', 0, 1498451503, 'enabled'),
(6, 7, 11, 'Python tutorial - TutorialsPoint', '&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n\n&lt;p&gt;&lt;em&gt;Python&lt;/em&gt;&amp;nbsp;&lt;strong&gt;Tutorial&lt;/strong&gt; for Beginners - Learn&amp;nbsp;&lt;em&gt;Python&lt;/em&gt;&amp;nbsp;in simple and easy steps starting from basic to advanced concepts with examples including&amp;nbsp;&lt;em&gt;Python&lt;/em&gt;&amp;nbsp;Syntax Object&amp;nbsp;...&lt;/p&gt; &lt;p&gt;&amp;nbsp;&lt;/p&gt;\n\n&lt;p&gt;&lt;em&gt;Python&lt;/em&gt;&amp;nbsp;&lt;strong&gt;Tutorial&lt;/strong&gt; for Beginners - Learn&amp;nbsp;&lt;em&gt;Python&lt;/em&gt;&amp;nbsp;in simple and easy steps starting from basic to advanced concepts with examples including&amp;nbsp;&lt;em&gt;Python&lt;/em&gt;&amp;nbsp;Syntax Object&amp;nbsp;...&lt;/p&gt;', '3e387ee1b513ff7c818eb1b548394dd29c032741_077127844a1ba0548b1cb9d5a28b9ebdbf8d962b.jpg', 'cs, programmong', '5', 0, 1498451800, 'enabled'),
(7, 7, 13, 'CSS Tutorial', '&lt;p&gt;CSS is a language that describes the style of an HTML document.&lt;/p&gt;\r\n\r\n&lt;p&gt;CSS describes how HTML elements should be displayed.&lt;/p&gt;\r\n\r\n&lt;p&gt;This tutorial will teach you CSS from basic to advanced.&lt;/p&gt;', '4ed82f38a9cc002249843aa04f93a5e28882a13f_5839ab9795aa379d8d4f5d8fb2ca924345b78f81.png', 'web, designs', '3,4', 0, 1498541005, 'enabled'),
(8, 7, 13, 'CSS Syntax and Selectors', '&lt;p&gt;The selector points to the HTML element you want to style.&lt;/p&gt;\r\n\r\n&lt;p&gt;The declaration block contains one or more declarations separated by semicolons.&lt;/p&gt;\r\n\r\n&lt;p&gt;Each declaration includes a CSS property name and a value, separated by a colon.&lt;/p&gt;\r\n\r\n&lt;p&gt;A CSS declaration always ends with a semicolon, and declaration blocks are surrounded by curly braces.&lt;/p&gt;\r\n\r\n&lt;p&gt;In the following example all &amp;lt;p&amp;gt; elements will be center-aligned, with a red text color:&lt;/p&gt;', 'ec0d3e02f7f864f5ce00400f1fc88929fc4dc058_43d88740daa0e30e218545dad017daac219cff24.png', 'web, designs', '7', 0, 1498541056, 'enabled'),
(9, 7, 13, 'CSS Selectors The element Selector', '&lt;p&gt;The element selector selects elements based on the element name.&lt;/p&gt;\r\n\r\n&lt;p&gt;You can select all &amp;lt;p&amp;gt; elements on a page like this (in this case, all &amp;lt;p&amp;gt; elements will be center-aligned, with a red text color):&lt;/p&gt;', 'd07111cdeb61f1aeb2bcf95c9d34b321ab9b1241_3bed76a6421ba3610aeaab3320f22968ee7113fa.jpg', 'web, designs', '4,7,8', 0, 1498541132, 'enabled'),
(10, 7, 13, 'The class Selector', '&lt;p&gt;The class &lt;em&gt;&lt;strong&gt;selector&lt;/strong&gt;&lt;/em&gt; selects elements with a specific class attribute.&lt;/p&gt;\r\n\r\n&lt;p&gt;To select elements with a specific class, write a period (.) character, followed by the name of the class.&lt;/p&gt;\r\n\r\n&lt;p&gt;In the example below, all HTML elements with class=&amp;quot;center&amp;quot; will be red and center-aligned:&lt;/p&gt;', 'ca1eee1d660142f8f0e01adf790804a73ea78cef_c404304e38510f7f4d28f7c5aedff489ce8a6bdf.jpg', 'web, designs', '7,8,9', 0, 1498541169, 'enabled'),
(11, 7, 13, 'CSS Demo - One HTML Page - Multiple Styles!', '&lt;ul&gt;\r\n	&lt;li&gt;&lt;strong&gt;CSS&lt;/strong&gt;&amp;nbsp;stands for&amp;nbsp;&lt;strong&gt;C&lt;/strong&gt;ascading&amp;nbsp;&lt;strong&gt;S&lt;/strong&gt;tyle&amp;nbsp;&lt;strong&gt;S&lt;/strong&gt;heets&lt;/li&gt;\r\n	&lt;li&gt;CSS describes&amp;nbsp;&lt;strong&gt;how HTML elements are to be displayed on screen, paper, or in other media&lt;/strong&gt;&lt;/li&gt;\r\n	&lt;li&gt;CSS&amp;nbsp;&lt;strong&gt;saves a lot of work&lt;/strong&gt;. It can control the layout of multiple web pages all at once&lt;/li&gt;\r\n	&lt;li&gt;External stylesheets are stored in&amp;nbsp;&lt;strong&gt;CSS files&lt;/strong&gt;&lt;/li&gt;\r\n&lt;/ul&gt;', 'c550032dd524a2ec754000ec6621065763e1cbc7_9c3e3c9b74d2370af12205fc2ef2d30b3926dad4.jpg', 'web, designs', '7,8,9,10', 0, 1498541205, 'enabled'),
(12, 7, 13, 'Same Page Different Stylesheets', '&lt;p&gt;This is a demonstration of how different stylesheets can change the layout of your HTML page. You can change the layout of this page by selecting different stylesheets in the menu, or by selecting one of the following links:&lt;br /&gt;\r\n&lt;a href=&quot;https://www.w3schools.com/css/demo_default.htm#&quot; onclick=&quot;reStyle(0);return false&quot;&gt;Stylesheet1&lt;/a&gt;,&amp;nbsp;&lt;a href=&quot;https://www.w3schools.com/css/demo_default.htm#&quot; onclick=&quot;reStyle(1);return false&quot;&gt;Stylesheet2&lt;/a&gt;,&amp;nbsp;&lt;a href=&quot;https://www.w3schools.com/css/demo_default.htm#&quot; onclick=&quot;reStyle(2);return false&quot;&gt;Stylesheet3&lt;/a&gt;,&amp;nbsp;&lt;a href=&quot;https://www.w3schools.com/css/demo_default.htm#&quot; onclick=&quot;reStyle(3);return false&quot;&gt;Stylesheet4&lt;/a&gt;.&lt;/p&gt;', '6930099b1560c17166ae0eeb16d037a71d340678_8e0137ac16f6297c75598cc17d5c3d24187d8cd0.jpg', 'web, designs', '10,11', 0, 1498541235, 'enabled'),
(13, 7, 13, 'The CSS Box Model', '&lt;p&gt;All HTML elements can be considered as boxes. In CSS, the term &amp;quot;box model&amp;quot; is used when talking about design and layout.&lt;/p&gt;\r\n\r\n&lt;p&gt;The CSS box model is essentially a box that wraps around every HTML element. It consists of: margins, borders, padding, and the actual content. The image below illustrates the box model:&lt;/p&gt;', 'fcaff401d46e04c76d8e94b4f8e5e18dd45d2b48_af970cff33ff563f3f909a381c7caeb19248c2e6.jpg', 'web, designs', '12', 0, 1498541290, 'enabled'),
(14, 7, 13, 'Width and Height of an Element', '&lt;p&gt;In order to set the width and height of an element correctly in all browsers, you need to know how the box model works.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Important:&lt;/strong&gt;&amp;nbsp;When you set the width and height properties of an element with CSS, you just set the width and height of the&amp;nbsp;&lt;strong&gt;content area&lt;/strong&gt;. To calculate the full size of an element, you must also add padding, borders and margins.&lt;/p&gt;', 'ec28b0cbd10623b9ae5c997fb59694fb939c7bfa_e816c69ec8e96247cf24eeca3ee4a91c9c2bdaa8.jpg', 'web, designs', '', 0, 1498541330, 'enabled'),
(15, 7, 13, 'TEXT FORMATTING', '&lt;p&gt;This text is styled with some of the text formatting properties. The heading uses the text-align, text-transform, and color properties. The paragraph is indented, aligned, and the space between characters is specified. The underline is removed from this colored&amp;nbsp;&lt;a href=&quot;https://www.w3schools.com/css/tryit.asp?filename=trycss_text&quot; target=&quot;_blank&quot;&gt;&amp;quot;Try it Yourself&amp;quot;&lt;/a&gt;&amp;nbsp;link.&lt;/p&gt;', '73007e132b49673ae78bdc584533f3500f38dc15_21b3b494164efc11b64b3d0f0867471e3dd45c42.png', 'web, designs', '11,12,13', 0, 1498541399, 'enabled'),
(16, 7, 13, 'Text Alignment Text Alignment', '&lt;p&gt;The&amp;nbsp;&lt;code&gt;text-align&lt;/code&gt;&amp;nbsp;property is used to set the horizontal alignment of a text.&lt;/p&gt;\r\n\r\n&lt;p&gt;A text can be left or right aligned, centered, or justified.&lt;/p&gt;\r\n\r\n&lt;p&gt;The following example shows center aligned, and left and right aligned text (left alignment is default if text direction is left-to-right, and right alignment is default if text direction is right-to-left):&lt;/p&gt;', '90805ce3e8939ea7cc91153f0e4b737fc9b9f574_8245bbcf1d56b8a07af6a3825c88583c3f525a4a.jpg', 'web, designs', '13,14,15', 0, 1498541443, 'enabled'),
(17, 7, 13, 'CSS - Learn web development', '&lt;p&gt;Global&amp;nbsp;&lt;em&gt;CSS&lt;/em&gt;&amp;nbsp;settings, fundamental HTML elements styled and enhanced with extensible classes, and an advanced grid system.&amp;nbsp;... Bootstrap includes a responsive, mobile first fluid grid system that appropriately scales up to 12 columns as the device or viewport size increases&lt;/p&gt;', '6f899e9b9c18f7db8577b1925760adb9523530a6_c30a96c0cc6314177c0a68038b03fb0936b7f8b3.png', 'web, designs', '15,16', 0, 1498542617, 'enabled');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'Site_Name', 'Blog'),
(2, 'Site_Email', 'admin@blog.com'),
(3, 'Site_Status', 'Enabled'),
(4, 'Site_Close_Message', 'Sorry we are in Maintaince'),
(5, 'Facebook', 'https://www.facebook.com/ahmedhdeawy'),
(6, 'Twitter', 'https://www.twitter.com/ahmedhdeawy'),
(7, 'Google', 'https://www.google.com/ahmedhdeawy'),
(8, 'Site_Info', 'Our Website Provide a lot of Articles in Computer Science Career and it available to publish your articles and your jobs....etc, please don\'t Stop and Type your articles to Help others.'),
(9, 'Youtube', 'https://www.youtube.com/channel/UCbno79YQAOiQSNtWR81qymg'),
(10, 'Site_Map', 'Al-Azhar University, Nasr City, Cairo-Egypt'),
(11, 'Site_Phone', '+201142950885'),
(12, 'Linked_In', 'https://www.linkedin.com/in/ahmedhdeawy/'),
(13, 'Site_Owner', 'Ahmed Hdeawy');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(96) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `birthday` int(11) NOT NULL,
  `image` text NOT NULL,
  `created` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `code` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_group_id`, `first_name`, `last_name`, `email`, `password`, `gender`, `birthday`, `image`, `created`, `status`, `ip`, `code`) VALUES
(7, 1, 'Ahmed', 'Hdeawy', 'ahmedhdeawy@gmail.com', '$2y$10$K9eZA5P44eNF18V8y4C91OsIs0c33FxNs71fIAEzxfyX3JPI8txeC', 'male', 781221600, 'Ahmed.jpg', 1497359641, '', '127.0.0.1', '2a0771ec91d68f90e6ad90288addb20d450a4b0f'),
(9, 2, 'Mohamed', 'Hdeawy', 'mohamedhdeawy@yahoo.com', '$2y$10$d0wnm0ZQcTRxyfL.5XxkSuSX6tkuUecfGuZJbCtOgabHsyoyGiRde', 'male', 894056400, '2675a6c37a1b7e3e52fdb9016464dd26b2a52ed6_b047c7ec1371039e6d51acab8d3634b0f05f4db7.jpg', 1497428056, 'enabled', '127.0.0.1', 'd2f5197c4a7fe47de62444ceafe79bc7d85f3b20'),
(18, 3, 'Aly', 'Ahmed', 'aly@gmail.com', '$2y$10$Y.foZyxzBqostkh0vc22XOMr8SfSDiYFD997MV1OO0HjKcOJBu3Fm', 'male', 736290000, 'b367080460c55583b94c095a00afa44dd076eac6_df95028b2d8e67e905823e0951a46815786c8d49.gif', 1498447166, 'enabled', '127.0.0.1', '7b0cb7d666d39675dea632ca25c0626982f40342'),
(19, 3, 'Taha', 'Osman', 'taha@gmail.com', '$2y$10$EP3FXQfgst1FPsUSs8VVQ.yAhyV6nVRsP2rIL75Dfi5FDtLVKdpaW', 'male', 797634000, '53a5e93fe035d1c54977887d38772a1d9f55d760_e30a99ff06b3f31baea86d8dcfdbc539076ef6fb.jpg', 1498629226, 'disabled', '127.0.0.1', '06eb578e5b5819e133b0ceef7c1bf31786946a1a');

-- --------------------------------------------------------

--
-- Table structure for table `users_group`
--

CREATE TABLE `users_group` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_group`
--

INSERT INTO `users_group` (`id`, `name`) VALUES
(1, 'Super Administrator'),
(2, 'Moderator'),
(3, 'User'),
(4, 'Author');

-- --------------------------------------------------------

--
-- Table structure for table `users_group_permissions`
--

CREATE TABLE `users_group_permissions` (
  `id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `page` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_group_permissions`
--

INSERT INTO `users_group_permissions` (`id`, `user_group_id`, `page`) VALUES
(1, 1, '/admin/login'),
(2, 1, '/admin/login/submit'),
(3, 1, '/admin'),
(4, 1, '/admin/dashboard'),
(5, 1, '/admin/submit'),
(6, 1, '/admin/users'),
(7, 1, '/admin/users/add'),
(8, 1, '/admin/users/submit'),
(9, 1, '/admin/users/edit'),
(10, 1, '/admin/users/save/:id'),
(11, 1, '/admin/users/delete/:id'),
(12, 1, '/admin/users-groups'),
(13, 1, '/admin/users-groups/add'),
(14, 1, '/admin/users-groups/submit'),
(15, 1, '/admin/users-groups/edit/:id'),
(16, 1, '/admin/users-groups/save/:id'),
(17, 1, '/admin/users-groups/delete/:id'),
(18, 1, '/admin/posts'),
(19, 1, '/admin/posts/add'),
(20, 1, '/admin/posts/xx/:id'),
(21, 1, '/admin/posts/submit'),
(22, 1, '/admin/posts/edit/:id'),
(23, 1, '/admin/posts/save/:id'),
(24, 1, '/admin/posts/delete/:id'),
(25, 1, '/admin/posts/:id/comments'),
(26, 1, '/admin/comments/edit/:id'),
(27, 1, '/admin/comments/save/:id'),
(28, 1, '/admin/comments/delete/:id'),
(29, 1, '/admin/categories'),
(30, 1, '/admin/categories/add'),
(31, 1, '/admin/categories/submit'),
(32, 1, '/admin/categories/edit/:id'),
(33, 1, '/admin/categories/save/:id'),
(34, 1, '/admin/categories/delete/:id'),
(35, 1, '/admin/settings'),
(36, 1, '/admin/settings/save'),
(37, 1, '/admin/contacts'),
(38, 1, '/admin/contacts/reply/:id'),
(39, 1, '/admin/contacts/send/:id'),
(40, 1, '/admin/ads'),
(41, 1, '/admin/ads/add'),
(42, 1, '/admin/ads/submit'),
(43, 1, '/admin/ads/edit:id'),
(44, 1, '/admin/ads/save:id'),
(45, 1, '/admin/ads/delete:id'),
(46, 1, '/admin/logout'),
(47, 2, '/admin/login'),
(48, 2, '/admin/login/submit'),
(49, 2, '/admin'),
(50, 2, '/admin/dashboard'),
(51, 2, '/admin/submit'),
(52, 2, '/admin/users'),
(53, 2, '/admin/users/add'),
(54, 2, '/admin/users/submit'),
(55, 2, '/admin/users/edit'),
(56, 2, '/admin/users/save/:id'),
(57, 2, '/admin/users/delete/:id'),
(58, 2, '/admin/users-groups'),
(59, 2, '/admin/users-groups/add'),
(60, 2, '/admin/users-groups/submit'),
(61, 2, '/admin/users-groups/edit/:id'),
(62, 2, '/admin/users-groups/save/:id'),
(63, 2, '/admin/users-groups/delete/:id'),
(64, 2, '/admin/posts'),
(65, 2, '/admin/posts/add'),
(66, 2, '/admin/posts/xx/:id'),
(67, 2, '/admin/posts/submit'),
(68, 2, '/admin/posts/edit/:id'),
(69, 2, '/admin/posts/save/:id'),
(70, 2, '/admin/posts/delete/:id'),
(71, 2, '/admin/posts/:id/comments'),
(72, 2, '/admin/comments/edit/:id'),
(73, 2, '/admin/comments/save/:id'),
(74, 2, '/admin/comments/delete/:id'),
(75, 2, '/admin/categories'),
(76, 2, '/admin/categories/add'),
(77, 2, '/admin/categories/submit'),
(78, 2, '/admin/categories/edit/:id'),
(79, 2, '/admin/categories/save/:id'),
(80, 2, '/admin/categories/delete/:id'),
(81, 2, '/admin/settings'),
(82, 2, '/admin/settings/save'),
(83, 2, '/admin/contacts'),
(84, 2, '/admin/contacts/reply/:id'),
(85, 2, '/admin/contacts/send/:id'),
(86, 2, '/admin/ads'),
(87, 2, '/admin/ads/add'),
(88, 2, '/admin/ads/submit'),
(89, 2, '/admin/ads/edit:id'),
(90, 2, '/admin/ads/save:id'),
(91, 2, '/admin/ads/delete:id'),
(92, 2, '/admin/logout'),
(93, 3, '/admin/login'),
(94, 3, '/admin/login/submit'),
(95, 4, '/admin/posts'),
(96, 4, '/admin/posts/add'),
(97, 4, '/admin/posts/xx/:id'),
(98, 4, '/admin/posts/submit'),
(99, 4, '/admin/posts/edit/:id'),
(100, 4, '/admin/posts/save/:id'),
(101, 4, '/admin/posts/delete/:id'),
(102, 4, '/admin/posts/:id/comments'),
(103, 4, '/admin/posts'),
(104, 4, '/admin/posts/add'),
(105, 4, '/admin/posts/xx/:id'),
(106, 4, '/admin/posts/submit'),
(107, 4, '/admin/posts/edit/:id'),
(108, 4, '/admin/posts/save/:id'),
(109, 4, '/admin/posts/delete/:id'),
(110, 4, '/admin/posts/:id/comments');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_users`
--
ALTER TABLE `online_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_group`
--
ALTER TABLE `users_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_group_permissions`
--
ALTER TABLE `users_group_permissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `online_users`
--
ALTER TABLE `online_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users_group`
--
ALTER TABLE `users_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users_group_permissions`
--
ALTER TABLE `users_group_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
