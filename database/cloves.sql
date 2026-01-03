-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2023 at 03:10 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cloves`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `page_name` varchar(255) DEFAULT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `button_name` varchar(255) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`page_name`, `id`, `heading`, `sub_title`, `description`, `image_path`, `button_name`, `button_link`, `created_at`, `updated_at`, `deleted_at`) VALUES
('AboutUs', 3, 'About Us', NULL, NULL, 'uploads/admin/banner/1665370502.png', NULL, NULL, NULL, '2022-10-09 21:55:02', NULL),
('Service', 4, 'Services', NULL, NULL, 'uploads/admin/banner/1665370652.png', NULL, NULL, NULL, '2022-10-09 21:57:32', NULL),
('Why Choose Us', 5, 'Why Choose Us', NULL, NULL, 'uploads/admin/banner/1665370671.png', NULL, NULL, NULL, '2022-10-09 21:57:51', NULL),
('FAQS', 6, 'FAQS', NULL, NULL, 'uploads/admin/banner/1665370690.png', NULL, NULL, NULL, '2022-10-09 21:58:10', NULL),
('Contact Us', 7, 'Contact Us', NULL, NULL, 'uploads/admin/banner/1665370709.png', NULL, NULL, NULL, '2022-10-09 21:58:29', NULL),
('Request', 15, 'Request Delivery Service', NULL, NULL, 'uploads/admin/banner/1665370746.png', NULL, NULL, NULL, '2022-10-09 21:59:06', NULL),
('Terms & Conditions', 16, 'Terms & Conditions', NULL, NULL, 'uploads/admin/banner/1665370746.png', NULL, NULL, NULL, '2022-10-13 18:53:22', NULL),
('USER_REGISTER', 17, 'Register as lead', NULL, NULL, 'uploads/admin/banner/1665370728.png', NULL, NULL, NULL, '2023-02-27 17:58:32', NULL),
('VENDOR_REGISTER', 18, 'Register as Pharmacy/Org', NULL, NULL, 'uploads/admin/banner/1665370728.png', NULL, NULL, NULL, '2023-03-07 14:37:18', NULL),
('LOGIN', 19, 'Login', NULL, NULL, 'uploads/admin/banner/1665370728.png', NULL, NULL, NULL, '2023-02-27 17:55:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `message` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `user_id`, `name`, `email`, `phone`, `purpose`, `address`, `message`, `created_at`, `updated_at`, `deleted_at`) VALUES
(124, NULL, 'Keegan Mcfadden', NULL, '174-552-3106', 'billing', 'Quia veritatis et sa', 'Labore dolores moles', '2023-02-01 15:38:54', '2023-02-01 20:38:54', NULL),
(125, 12, 'Thane Sykes', NULL, '132-652-6283', 'Other', 'Voluptatum consequat', 'Minima qui sunt rep', '2023-02-01 15:43:57', '2023-02-01 20:43:57', NULL),
(126, NULL, 'Jhon Doe', 'John@Melton.com', '161-151-9475', 'Other', 'Distinctio Voluptat', 'Ut aliqua Lorem ex', '2023-02-01 22:40:22', '2023-02-02 03:40:22', NULL),
(127, 175, 'Eve Hill', NULL, '150-654-1953', 'Delivery Inquiry', 'Ad adipisicing vel q', 'Totam qui dicta cumq', '2023-02-01 20:25:20', '2023-02-02 01:25:20', NULL),
(128, 175, 'Brynne Whitehead', 'burks@gmail.com', '164-558-1629', 'Sales', 'Nihil in omnis enim', 'Quod est temporibus', '2023-02-01 20:31:56', '2023-02-02 01:31:56', NULL),
(129, 1, 'Mack Jhon', 'admin@cloves.com', '943-875-7394', 'Support', 'Ad adipisicing vel q', 'Dummy', '2023-02-13 16:03:31', '2023-02-13 21:03:31', NULL),
(130, 1, 'Abraham Mcclure', 'admin@cloves.com', '147-332-8165', 'Other', 'Voluptate velit ita', 'Aut sapiente eiusmod', '2023-02-13 16:16:32', '2023-02-13 21:16:32', NULL),
(131, 2020, 'Mack Borisan', 'mack@gmail.com', '345-345-3453', 'Support', 'Culpa sed adipisci v', 'adf', '2023-02-13 16:47:12', '2023-02-13 21:47:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `description2` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `title1` varchar(255) DEFAULT NULL,
  `text1` text DEFAULT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `title2` text DEFAULT NULL,
  `text2` text DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `title3` varchar(255) DEFAULT NULL,
  `text3` text DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `title4` varchar(255) DEFAULT NULL,
  `image4` varchar(255) DEFAULT NULL,
  `text4` varchar(255) DEFAULT NULL,
  `title5` varchar(255) DEFAULT NULL,
  `image5` varchar(255) DEFAULT NULL,
  `text5` varchar(255) DEFAULT NULL,
  `title6` varchar(255) DEFAULT NULL,
  `image6` varchar(255) DEFAULT NULL,
  `text6` varchar(255) DEFAULT NULL,
  `button1` varchar(255) DEFAULT NULL,
  `button1link` varchar(255) DEFAULT NULL,
  `button2` varchar(255) DEFAULT NULL,
  `button2link` varchar(255) DEFAULT NULL,
  `button3` varchar(255) DEFAULT NULL,
  `button3link` varchar(255) DEFAULT NULL,
  `button4` varchar(255) DEFAULT NULL,
  `button4link` varchar(255) DEFAULT NULL,
  `phone1` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `page_section` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `page_name`, `title`, `subtitle`, `description`, `description2`, `image_path`, `title1`, `text1`, `image1`, `title2`, `text2`, `image2`, `title3`, `text3`, `image3`, `title4`, `image4`, `text4`, `title5`, `image5`, `text5`, `title6`, `image6`, `text6`, `button1`, `button1link`, `button2`, `button2link`, `button3`, `button3link`, `button4`, `button4link`, `phone1`, `phone2`, `created_at`, `updated_at`, `deleted_at`, `page_section`, `status`) VALUES
(14, 'Contact Us', 'CONTACT DETAILS', NULL, NULL, NULL, NULL, 'HAVE A QUESTION', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '2022-10-10 12:36:58', '2022-02-03 22:48:01', 'Contact Section', 0),
(21, 'Service', 'Services We Provide', NULL, 'Our service caters to the prescription delivery needs of independent pharmacies across Southern California.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Methods', NULL, NULL, NULL, '', '', NULL, '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '2022-10-13 15:12:26', NULL, 'Services', 1),
(24, 'About Us', 'About Us', NULL, '<p style=\"font-family: Roboto; line-height: 30px; font-size: 18px;\">ClovesRX Global is a full-service prescription delivery company that offers safe and secure delivery for all types of medications to patients around southern California. We have the solution for your on-time prescription delivery challenges, since we take all precautions necessary to deliver the medications to patients on time. No matter the type of prescription, we have the right experience to deliver them whenever and whenever your customers require it.</p><p style=\"font-family: Roboto; line-height: 30px; font-size: 18px;\">Being a faith-based entity, our mission is to serve our community. We believe by delivering needed medications on time, we are servicing the people of God and fulfilling His commandants. Why wait? Let us help your pharmacy connect with the right healthcare centers and individuals, and together we can serve our community.</p>', NULL, 'uploads/admin/CMS/16654358211.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-13 15:35:10', NULL, 'About Us Section', 1),
(25, 'Why Choose Us', 'Everyone deserves good health and wellness. We go the distance to deliver your prescriptions with ACCURACY, SPEED and CARE!', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '2022-10-10 15:47:34', NULL, 'Why Choose Us', 1),
(27, 'Development', 'Children', NULL, '[\"fgdfg\"]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-22 19:33:50', '2022-07-25 20:12:01', 'Children Section', 1),
(28, 'Development', 'Women', NULL, 'Women health', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-22 19:32:05', '2022-07-25 20:13:12', 'Women Section', 1),
(29, 'Development', 'Youth', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-19 20:47:08', '2022-07-25 22:39:51', 'Youth Section', 1),
(31, 'Press', 'In the News', NULL, 'Boom Journal coverage and featured article', NULL, 'uploads/admin/CMS/16599831881.jpg', NULL, NULL, 'uploads/admin/CMS/16599823251.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-08 13:26:28', '2022-07-25 23:27:18', 'News Section', 1);
INSERT INTO `contents` (`id`, `page_name`, `title`, `subtitle`, `description`, `description2`, `image_path`, `title1`, `text1`, `image1`, `title2`, `text2`, `image2`, `title3`, `text3`, `image3`, `title4`, `image4`, `text4`, `title5`, `image5`, `text5`, `title6`, `image6`, `text6`, `button1`, `button1link`, `button2`, `button2link`, `button3`, `button3link`, `button4`, `button4link`, `phone1`, `phone2`, `created_at`, `updated_at`, `deleted_at`, `page_section`, `status`) VALUES
(32, 'Privacy And Policy', 'BOOM JOURNAL PRIVACY POLICY.', NULL, '<p style=\"margin-top:0in;margin-right:0in;margin-bottom:15.0pt;margin-left:\r\n0in;line-height:22.5pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">The information in this document applies to our website and\r\nmobile application visitors and users (“users”, “you”, “your”).<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">Protecting\r\nYour Personal Information<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Welcome\r\nto Boom Journal, your new Emotional Fitness Trainer.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Boom\r\nis here to help you feel your inspired, energized, and joyful, offering you\r\nboth a place to jot down what\'s on your mind as well as guided Journals.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">The\r\nfollowing document sets forth our “Privacy Policy,” which governs our use of\r\nthe Personal Information (as defined below) you submit through your use of our\r\nService (as described below). Please read our Privacy Policy carefully.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Maintaining\r\nyour information’s privacy is of paramount importance to us as it helps foster\r\nconfidence, goodwill, and stronger relationships with you, our users. If, at\r\nany time, you have questions or concerns about our privacy practices, please\r\nfeel free to contact us at hello@boomjournal.com.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">We\r\nunderstand that there is a lot of information in this Privacy Policy. We have\r\ntried to make it as accessible, precise, and transparent as possible. However,\r\nif you still find that it is too dense or daunting, here are the answers to the\r\ntop three questions that we are commonly asked:<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">Top 3\r\nQuestions<o:p></o:p></span></h4>\r\n\r\n<h6 style=\"margin: 0in 0in 16.5pt; line-height: 17.25pt; text-transform: capitalize;\"><b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\">Q1 - What Does Boom Do With Your\r\nPersonal Information, Journal Entries, And Other Data?<o:p></o:p></span></b></h6>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Your\r\njournal entries are meant to be read and accessible only by you. Your entries\r\nare encrypted by default by Boom, except for certain items such as some entries\r\ntitles, moods and activities you enter. Moreover, we highly recommend that you\r\nadd an additional layer of encryption by encrypting your journal entries with\r\nyour own encryption key which you can set up in the settings. This will prevent\r\nanyone to access your journal entries without your own encryption key. We don\'t\r\nsell any of your data with third parties. We are making money by offering\r\npremium services and not by selling your personal data.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">We\r\ncan share some of your data (excluding any journal entries of course!) with\r\nthird parties but only in compliance with the terms of our Privacy Policy below\r\nand mainly to conduct research on users\' demographics, interests, and behavior\r\nand help continually improve our Service. We do have to analyze some data in\r\ncase of crashes, and we can look at meta-data to see how many people are\r\njournaling at any given time, or generally how users interact with the Jour\r\nApp, but that’s about it. We do advertise our services, so you may be\r\nretargeted by some ads, but once again, we have no access to your personal\r\njournal entries.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">Q2 - If You\r\nTerminate Your Account, Does Your Data Get Erased/Anonymized?<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Yes!\r\nExcept for any logs that we might still have in our system or in the systems of\r\nsome of our third-party providers. But we can never see anything that you\r\njournal and you can still exercise your right to erasure at\r\nhello@boomjournal.com.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">Q3 - Are Your\r\nPersonal Information Safe On Boom Journal?<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Boom\r\njournal uses all appropriate technical and organizational measures to protect\r\nyour Personal Information on the App. We take reasonable steps to protect your\r\ninformation from loss, misuse, unauthorized access, disclosure, alteration or\r\ndestruction. Measures we take, include - but are not limited to, the following:\r\nwe offer you to encrypt the content you write using the Advanced Encryption\r\nStandard (AES) with an encryption key of your choice. Your password is stored\r\nas a bcrypt hash, so nobody can see it, including members of Boom\'s team. We\r\nkeep track of security vulnerabilities of every dependency we use, on any\r\nproject, to make sure it\'s fixed as soon as possible. We back up regularly our\r\ndatabase to make sure no user data is lost if something unexpected happens.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">1. Who Are We?<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">West\r\nLabs LLC is the owner of the Boom journal mobile application (“we”, “us”,\r\n“our”, “Boom” or the “App”). Boom journal is a mobile application that allows\r\nits users to create and maintain a mobile diary or journal through daily\r\ncheck-ins and guided, step-by-step support on a wide array of topics (the\r\n\"Service”). You can choose to sign up for a free account, or to sign up\r\nfor a premium account with additional features and content. For the purpose of\r\nthis Privacy Policy, both the free account and the premium account are referred\r\nto collectively as the “Service”, unless otherwise indicated. The Privacy\r\nPolicy goes hand-in-hand with our Terms of Use, which govern all use of the\r\nService and can be found here. Please read them together.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">West\r\nLabs LLC. is the responsible party or data controller regarding personal\r\ninformation collected through our Service. If you have any questions or\r\nconcerns at any time about your data, privacy, or our Terms of Use, please\r\nemail us at hello@boomjournal.com.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">2. What Is The\r\nPurpose Of This Privacy Policy?<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Our\r\nPrivacy Policy explains how we collect, use, maintain and disclose your\r\nPersonal Information when using the App. This includes information that\r\nidentify or could be used to identify you (“Personal Information”), and other\r\ninformation that does not constitute Personal Information (“Non-Personal\r\nInformation”) that is collected from you while using our Service. We take the\r\nprivacy of your Personal Information very seriously. All individuals whose\r\nresponsibilities include the processing of any Personal Information are\r\nrequired to follow our Privacy Policy, lastly updated 1/20/21.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">We\r\nissued this Privacy Policy to ensure that we have standards in place to protect\r\nthe Personal and Non-Personal Information that we may collect from you while\r\nusing our Service. Collecting your Personal Information may be necessary for\r\nproviding our Service, and is a consequence of the normal operations of our\r\nbusiness. We published this Privacy Policy to make it easy for you to\r\nunderstand what Personal Information we collect and store, why we do so, how we\r\nreceive and/or obtain that information, and the rights you have over your\r\nPersonal Information or data in our possession.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">3. What Personal\r\nInformation Do We Process About You?<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">We\r\nwant you to understand the types of information we collect as you use our\r\nServices. When using our Services, it may be necessary for us to collect both\r\nNon-Personal Information and Personal Information about you.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">We\r\nwill collect Personal Information from you if you submit such information to us\r\nwhile using our Service; but also, if you passively submit such information.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">For\r\nthe purposes described below in section 4, we may collect the following\r\ncategories of Personal Information:<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">dentification\r\nand Contact information: such as your first name &amp; name, gender and email\r\naddress;<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Information\r\nuploaded by you on the App: such as your moods, activities, photos &amp;\r\ngeolocation (for instance, when you accept Boom Journal to access your Photo\r\nvia Apple PhotoKit), text, comments, using our Service;<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Financial\r\nInformation: such as your credit card details, bank account numbers, PayPal\r\naccount details and other payment details used to transact with Boom Journal.\r\nPlease note that we do not directly collect or process these financial\r\ninformation used to transact with Boom Journal (the \"Financial\r\nInformation\"). However, Apple (and if applicable Google) collect Financial\r\nInformation with respect to in-app purchases made through the App and our\r\npayment processor (which is Stripe, Inc. https://stripe.com) collects Financial\r\nInformation with respect to purchases made through our<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 0.0001pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">website&nbsp;<a href=\"http://localhost/waheed/mental-wellness-html/privacy.html\" style=\"white-space: initial;\"><b><span style=\"color: black;\">https://www.boomjournal.com/</span></b></a>.\r\nSuch payment processors generally provide us with some limited information\r\nrelated to you, such as a unique token that enables you to make additional\r\npurchases using the information they’ve - stored, and your credit card’s type,\r\nexpiration dates, billing address, and the last four digits of your card\r\nnumber;<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Recruitment\r\ndata: your resume, application letter, professional qualifications, work\r\nexperience;<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Information\r\nrelated to connexion: such as cookies and similar technologies like pixels, web\r\nbeacons, and local storage, flash LSOs, geolocation, information collected via\r\nanalytics software provided by third parties collecting information engagement\r\nwith the Service, the events that occur within the Service, aggregated usage\r\nand performance data, and where the App was downloaded from;<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Information\r\nstored in Log files: such as IP addresses, browser/device type, Internet\r\nservice provider (“ISP”), referring/exit pages, operating system, date/time\r\nstamp, and clickstream data;<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Aggregated\r\nData: So that we can continually improve our Service, we and our analytics\r\npartners often conduct research on user demographics, interests, and behavior\r\nwhile using our Service. This is based on information that we have collected,\r\nand may be compiled and analyzed on an aggregate basis;<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Statistical\r\nInformation: We and our analytics partners may collect information about your\r\nonline and offline preferences, habits, movements, trends, decisions,\r\nassociations, memberships, finances, purchases and other information for\r\nstatistical purposes;<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Communications\r\nand Workflow: We collect some communication information about your activity and\r\nengagement when you use our support service. We also collect your information\r\nwhen you wish to set an e-meeting with us, to share with us your ideas about\r\nnew features you would like to see on Jour or when providing us with your feedbacks.\r\nHowever, we will never collect information about your private communications;<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Information\r\nto protect you, other users on the App and the public: We collect some data to\r\nprotect you and other users on the App and the public. For this purpose, we\r\ncollect IP addresses, hashed version of your password and encrypted version of\r\nyour encryption key;<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">HealthKit:\r\nif you are using iOS devices, you may opt-in in the App settings to allow the\r\nService to provide for instance data regarding the amount of minutes journaling\r\nto the Apple iOS “Health” application for display as well as any new features\r\nthat we will be releasing and offering as we go along. This data will not be\r\nshared with third parties or used for marketing purposes;<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Other\r\nInformation: We may collect other Personal Information about you, which we will\r\nprotect according to this Privacy Policy. We may also collect Non-Personal\r\nInformation about you such as information about your network, device, or\r\noperating system.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">4. Why And How Do\r\nWe Process Personal Information About You?<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Most\r\ninformation is collected in association with your use of the Service. In\r\nparticular, information is likely to be processed as follows:<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 0.0001pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\"><a href=\"http://localhost/waheed/mental-wellness-html/privacy.html\" style=\"white-space: initial;\"><b><span style=\"color: black;\">Data Processing Recap</span></b></a><o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Boom\r\nJournal does not aim to process special categories of data about you such as\r\ninformation about your health, genetic, religious, ethnicity, religion, trade\r\nunion membership, genetic and biometric data, sexual orientation or sex life.\r\nIf we were to process such data, please be sure that we shall only do so in\r\naccordance with applicable laws and regulations.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Please,\r\nnote that Boom Journal may feature public forums where you and users with\r\nsimilar issues, interests, or conditions can share information and support one\r\nanother or maybe in the future where you can post questions for experts to\r\nanswer. Our forums are open to the public and should not be considered private.\r\nAny information (including Personal Information) you share in any online forum\r\nis by design open to the public and is not private. You should think carefully\r\nbefore posting any Personal Information in any public forum. What you post can\r\nbe seen, disclosed to or collected by third parties and may be used by others\r\nin ways we cannot control or predict, including to contact you for unauthorized\r\npurposes. As with any public forum on any site, the information you post may\r\nalso show up in third-party search engines. If you mistakenly post Personal\r\nInformation in our Public Forums and would like it removed, you can send your\r\nright request below and send us an email to request that we remove it by using\r\nthe following contact<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 0.0001pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">address:<a href=\"http://localhost/waheed/mental-wellness-html/privacy.html\" style=\"white-space: initial;\"><b><span style=\"color: black;\">&nbsp;hello@boomjournal.com</span></b></a><o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Also,\r\nour Service may include social media features. These features may collect your\r\nIP address and which page you are visiting on our Service, and may set a cookie\r\nto enable the feature to function properly. Social media features are either\r\nhosted by a third party or hosted directly on our Service. Your interactions\r\nwith these features are governed by the privacy policy of the company providing\r\nthem.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">We\r\nunderstand that there are many circumstances in which we may collect\r\ninformation, and we work hard to ensure that you are always aware when your\r\nPersonal Information is being collected.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">Where Do We\r\nProcess Your Personal Information?<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Boom\r\nJournal has one headquarters in the United States. Personal Information about\r\nyou may be accessible to Boom Journal headquarter in the United States.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Where\r\nwe process information in countries that may not provide the same level of protection\r\nas your own country, Boom Journal will implement reasonable and appropriate\r\nlegal and security measures to protect your information from unauthorized\r\naccess, use or disclosure including, but not limited to, maintaining binding\r\ncontracts that require appropriate protection of information about users.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">For\r\nresidents of European Economic Area (“EEA”) – whenever we transfer your\r\ninformation outside of the EEA or Switzerland, we will take necessary steps to\r\nensure that adequate safeguards are put in place to protect your information.\r\nSuch safeguards include the use of European Commission approved standard\r\ncontractual clauses.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">Do We Disclose\r\nYour Personal Information?<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Boom\r\nJournal discloses your Personal Information only in accordance with local\r\napplicable laws and regulations, and appropriate safeguards will be\r\nestablished, where possible, to protect your information. Boom Journal may\r\ndisclose information to any member of our group of companies.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">In\r\norder to conduct Boom Journal Services, Boom Journal may also disclose your\r\nPersonal Information to the following third parties:<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Agents,\r\nConsultants, and Related Third Parties. Like many businesses, we sometimes have\r\ncompanies perform certain business-related functions for us. These companies\r\ninclude our marketing agencies, analytics service providers such as Segment and\r\nAmplitude, database service providers, backup and disaster recovery service\r\nproviders, email service providers, and others. For example, Facebook may\r\ncollect or receive information from our Service and use that information to\r\nprovide measurement services and targeted ads. When we engage another company,\r\nwe may provide them with your Personal Information -- with your consent, so\r\nthey can perform their designated functions.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">From\r\ntime to time, we may partner with other businesses to improve our Service (like\r\noffering new features and/or branded content). In order to execute these\r\npartnerships, we may have to share some of your Personal Information (like your\r\nemail address-but never your journal entries) with these third-party partners\r\nbut we won\'t do it without your explicit consent. In some circumstances, we may\r\ndisclose some of the Personal Information that you have provided to Boom\r\nJournal to a third party that offers and/or provides goods or services\r\ncomplementary to our own for the purpose of enhancing our users’ experiences by\r\noffering you integrated or complementary features, complementary services or\r\nbundled pricing options.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Corporate\r\nRestructurers. We may share some or all of your Personal Information in\r\nconnection with or during negotiation of any merger, financing, acquisition or\r\ndissolution transaction or proceeding involving sale, transfer, divestiture, or\r\ndisclosure of all or a portion of our business or assets. In the event of an\r\ninsolvency, bankruptcy, or receivership, Personal Information may also be\r\ntransferred as a business asset. If another company acquires our company,\r\nbusiness, or assets, that company will possess the Personal Information\r\ncollected by us and will assume the rights and obligations regarding your\r\nPersonal Information as described in this Privacy Policy.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Payment\r\nprocessor. Apple, Inc., our payment processor, collects Financial Information\r\nwith respect to your purchases made through our website in order to proceed\r\nwith your payment.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">User\r\nTestimonials and Feedback. We often receive testimonials and comments from\r\nusers who have had positive experiences with our Service. We occasionally\r\npublish such content. We may post user feedback on our website and/or other\r\nmedia from time to time. If we choose to post your first and last name along\r\nwith your feedback, we will ask for your consent prior to posting your name\r\nwith your feedback. If you make any comments on a blog or forum associated with\r\nyour site, you should be aware that any Personal Information you submit there\r\ncan be read, collected, or used by other users of these forums, and could be\r\nused to send you unsolicited messages. We are not responsible for the\r\npersonally identifiable information you choose to submit in these blogs and\r\nforums.<o:p></o:p></span></p>\r\n\r\n<h6 style=\"margin: 0in 0in 16.5pt; line-height: 17.25pt; text-transform: capitalize;\"><b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\">There Are A Few Other\r\nCircumstances Where We Must Disclose Users\' Personal Information - Such As The\r\nFollowing:</span></b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\"><o:p></o:p></span></h6>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Where\r\nwe have strong reasons to believe that an individual may be engaged in\r\nfraudulent, deceptive, or unlawful activity that a governmental authority\r\nshould know about;<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">In\r\nresponse to lawful requests by public authorities, including to meet national\r\nsecurity or law enforcement requirements; or as required by any law or\r\nregulation; to third parties such as public/regulatory authorities/governmental\r\nbodies (government, including social and benefits departments);<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">To\r\nprotect the rights, property, or personal safety of another user or any member\r\nof the public;<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">In\r\nspecial cases, to protect our users such as in response to a physical threat to\r\nyou or others.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">We\r\ncan assure you that we do not disclose or sell your Personal Information to\r\nunrelated third parties under any circumstances, ever. We do not sell, trade,\r\nor rent your Personal Information to others. In any case, Boom does not make\r\nyour Personal Information available to third parties for their marketing\r\npurposes without your consent. Moreover, if you have setup your encryption key\r\n(which we recommend you to do!), it adds another high-level layer of protection\r\nfor your journal entries not to be accessed by anyone but you. Please, make\r\nsure you keep your encryption key safe as Boom will not be able to retrieve it\r\nfor you should you forget it.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">What Are Your\r\nRights?<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Right\r\nto access and/or request a copy of your Personal Information. Under applicable\r\nprivacy law (e.g. European data privacy law, local data privacy laws etc.), you\r\nmay have a right to access and/or request a copy of information about you held\r\nby Boom Journal.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Right\r\nto update, correct, delete your Personal Information. You may also have the\r\nright to update, correct, or delete Personal Information, which is incomplete,\r\nout of date or inaccurate. Your information can be updated by you in the App.\r\nFor any question on how to do it or if you have issues in doing so, please\r\ncontact us at hello@boomjournal.com. Please note that it is your responsibility\r\nto provide us with accurate and truthful information. We cannot be liable for\r\nany information that is provided to us that is incorrect. Also, you can request\r\nthe deletion of your Personal Information if:<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l1 level1 lfo1;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">your Personal Information is no longer necessary for the purpose\r\nof the data processing,<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l1 level1 lfo1;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">you have withdrawn your consent on the data processing based\r\nexclusively on such consent,<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l1 level1 lfo1;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">you objected to the data processing,<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l1 level1 lfo1;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">the Personal Information processing is unlawful,<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l1 level1 lfo1;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">the Personal Information must be erased to comply with a legal\r\nobligation applicable to Boom.<o:p></o:p></span></p>\r\n\r\n<h6 style=\"margin: 0in 0in 16.5pt; line-height: 17.25pt; text-transform: capitalize;\"><b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\">Right To Restrict Processing Of\r\nYour Personal Information. You Can Request The Restriction Of The Processing:</span></b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\"><o:p></o:p></span></h6>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l4 level1 lfo2;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:12.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">in the event the accuracy of your Personal Information is\r\ncontested to allow Boom Journal to check such accuracy,</span><span style=\"font-size:12.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\"><o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l4 level1 lfo2;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">if you wish to restrict your Personal Information rather than\r\ndeleting it despite the fact that the processing is unlawful,<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l4 level1 lfo2;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">if you wish Boom to keep your Personal Information because you\r\nneed it for your defense in the context of legal claims,<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l4 level1 lfo2;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">if you have objected to the processing but Boom conducts\r\nverification to check whether it has legitimate grounds for such processing\r\nwhich may override your own rights.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Right\r\nto data portability. You can ask for the portability of your Personal\r\nInformation.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Right\r\nto withdraw consent. When your information processing is based on your consent,\r\nyou may withdraw any consent you previously provided to us at any moment. Such\r\nwithdrawal shall not affect the lawfulness of processing based on consent\r\nbefore its withdrawal.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Right\r\nto object to processing of your Personal Information. You may have the right to\r\nobject to processing of your Personal Information, including information being\r\nused for the purposes of direct marketing. When you receive newsletters or\r\npromotional communications from us, you may indicate a preference to stop\r\nreceiving further communications from us and you will have the opportunity to\r\n“opt-out” by following the unsubscribe instructions provided in the e-mail you\r\nreceive or by contacting us directly at hello@iammattwest.com. Despite your\r\nindicated e-mail preferences, we may send you service-related communications,\r\nincluding notices of any updates to our Terms of Use or Privacy Policy.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Right\r\nto instructions after death. Depending on your country, you may also have the\r\nright to provide us with your instructions regarding the storage, deletion or\r\ndisclosure of your Personal Information after your death. Such instructions may\r\nbe general or specific.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Right\r\nto lodge a complaint. In the event that any individual located in the EEA\r\ncountries or Switzerland believes that Boom Journal has processed Personal\r\nInformation in a manner that is unlawful or breaches his/her rights, or has\r\ninfringed the “General Data Protection Regulation”, such individual has the\r\nright to complain directly to the applicable Data Protection Authority.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Your\r\nrights may be subject to limited applicable legal and regulatory restrictions.\r\nTo exercise your individual rights please write to hello@boomjournal.com.\r\nDepending on the applicable laws and the nature of the request, individuals may\r\nbe required to provide some additional information.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">California-Specific\r\nRights. Under the California Consumer Privacy Act 2018 (CCPA), California\r\nresidents have specific rights regarding their personal information held by\r\nprivate companies. California consumers can reference their detailed applicable\r\nrights below.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">How Do We\r\nEnsure The Safety &amp; Security Of Your Personal Information?<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">We\r\nare committed to protecting the security of your Personal Information. Boom\r\nJournal uses appropriate technical and organizational measures to protect your\r\nPersonal Information. We take reasonable steps to protect your information from\r\nloss, misuse, unauthorized access, disclosure, alteration or destruction. We\r\nuse a variety of state-of-the-art encryption technologies and procedures to\r\nhelp protect your Personal Information from unauthorized access, use, or\r\ndisclosure. No method of transmission over the Internet, or method of\r\nelectronic storage, is 100% secure, however. Therefore, while we take all\r\nnecessary and extraordinary efforts to protect your Personal Information, we\r\ncannot guarantee its absolute security.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Encrypting\r\nthe content of your entries. We strongly recommend you to encrypt the content\r\nof your entries by setting up your own encryption key from the settings in the\r\nApp and setting up a password at the time create your account information.\r\nPlease do not disclose your encryption key nor your account password to\r\nunauthorized people and do not forget your encryption key. IF YOU DECIDE TO\r\nENCRYPT YOUR JOURNAL THEN NO ONE — INCLUDING ANYONE ON OUR TEAM — WILL EVER\r\nHAVE ACCESS TO THE CONTENTS OF YOUR JOURNAL. WE CAN NEVER READ, USE OR SHARE\r\nANY ENCRYPTED JOURNAL ENTRY. PLEASE DO NOT LOSE OR FORGET YOUR ENCRYPTION KEY\r\nAS THERE IS ABSOLUTELY NO WAY FOR US TO RETRIEVE IT FOR YOU. IF YOU LOSE OR\r\nFORGET YOUR ENCRYPTION KEY, YOUR ENTRIES WILL BE LOST FOREVER.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Phishing.\r\nIt has become increasingly common for unauthorized individuals to send e-mail\r\nmessages to consumers, purporting to represent a legitimate company such as a\r\nbank or on-line merchant, requesting that the consumer provide personal, often\r\nsensitive information. Sometimes, the domain name of the e-mail address from\r\nwhich the e-mail appears to have been sent, and the domain name of the web site\r\nrequesting such information, appears to be the domain name of a legitimate,\r\ntrusted company. In reality, such sensitive information is received by an\r\nunauthorized individual to be used for purposes of identity theft. This illegal\r\nactivity is known as “phishing”. If you receive an e-mail or other\r\ncorrespondence requesting that you provide any sensitive information (including\r\nyour password or credit card information) via e-mail or to a website that does\r\nnot seem to be affiliated with us, or that otherwise seems suspicious to you,\r\nplease do not provide such information, and report such request to us at\r\nhello@boomjournal.com.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Third\r\nParty Use. To the extent permitted by applicable laws, we are not responsible\r\nfor the privacy or security practices of any third party; this includes third\r\nparties to whom we are permitted to disclose your Personal Information in\r\naccordance with this policy or any applicable laws. The collection and use of\r\nyour information by these third parties may be subject to separate privacy and\r\nsecurity policies.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Unauthorized\r\nAccess. If you suspect any misuse, loss of, or unauthorized access to your\r\nPersonal Information, you should let us know immediately at hello@boomjournal.com.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Authorized\r\nUse. We are not liable for any loss, damage, or claim arising out of another\r\nperson’s use of the Personal Information where we were authorized to provide\r\nthat person with the Personal Information.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Location\r\nof our Servers. All data you provide to us through the Service is stored on\r\nservers located in the United States and managed by Amazon Web Services, Inc.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">How Long Do We\r\nRetain Your Personal Information?<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Unless\r\nindicated otherwise, Boom Journal makes sure to retain your Personal\r\nInformation for no longer than is necessary for the specific purposes for which\r\nit was collected. Your Personal Information may be retained for a longer\r\nduration where applicable laws or regulations require, or allow Boom Journal to\r\ndo so.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">This\r\nmeans that you may close your account by contacting us at\r\nhello@boomjournal.com, but we may retain Personal or Non-Personal Information\r\nfor an additional period as is permitted or required under applicable laws.\r\nEven after we delete your Personal Information, it may persist on backup or\r\narchival media for an additional period of time where applicable laws or\r\nregulations require, or allow Boom to do so.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">Do We Process\r\nChildren Personal Information?<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Boom\r\njournal website and App are not intended or designed for children under the age\r\nof 13. We do not knowingly collect Personal Information from children under the\r\nage of 13.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">If\r\nyou have reason to believe that a child under the age of 13 has used our\r\nService and provided Personal Information to us, please contact us at hello@boomjournal.com,\r\nand we will work to delete those Personal Information from our servers without\r\nundue delay.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">If\r\nyou are under the age of 18, you must have your parent\'s permission to access\r\nand use our Service.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">Do We Use\r\nCookies?<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Boom\r\nJournal uses a technology known as “cookies” and similar tracking technologies\r\non its website only. Please, read our Cookies Policy carefully here.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 0.0001pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">****For more\r\ninformation about types of cookies and how to manage cookies, including how to\r\nblock them and delete them, please visit<a href=\"http://localhost/waheed/mental-wellness-html/privacy.html\" style=\"white-space: initial;\"><b><span style=\"color: black;\">&nbsp;http://www.allaboutcookies.org</span></b></a><o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">Change To This\r\nPrivacy Policy<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">We\r\nmay revise from time to time our Privacy Policy. If we make any material\r\nchanges to our Privacy Policy, we will post updates on the Service: we will\r\npost the new Privacy Policy on the Website and its App with a new effective\r\ndate to notify you of these changes and/or we will notify you by sending you an\r\nemail or other notification as required by applicable law (the\r\n“Modifications”). Modifications will apply to all current and past users of the\r\nServices as of its effective date and will replace any prior policies. In\r\naddition, by accessing the Services on or after the effective date, you are\r\ndeemed to consent to our then-current Modifications.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Please\r\nreview this Privacy Policy periodically for changes, and especially before you\r\nprovide any Personal Information. If Modifications to this Privacy Policy are\r\nnot acceptable to you, you should cease accessing, browsing, and otherwise\r\nusing the Service.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">Contacting Us<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">If\r\nyou have any questions about this Privacy Policy, your dealings with our\r\nService, or a complaint about our handling of your Personal Information, please\r\ncontact us at: hello@boomjournal.com.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">CALIFORNIA\r\nCONSUMER INFORMATION :<o:p></o:p></span></h4>\r\n\r\n<h6 style=\"margin: 0in 0in 16.5pt; line-height: 17.25pt; text-transform: capitalize;\"><b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\">PRIVACY STATEMENT-CALIFORNIA<o:p></o:p></span></b></h6>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">This\r\nCalifornia Consumer Information supplements the information contained in the\r\nPrivacy Policy of Boom (“we”, “us”, “our”, “Boom Journal” or the “App”) and\r\napplies solely to visitors or users of Boom Journal who reside in the State of\r\nCalifornia (“consumers” or “you”). We adopt this notice to comply with the\r\nCalifornia Consumer Privacy Act of 2018 (“CCPA”) and other California privacy\r\nlaws. Any terms defined in the CCPA have the same meaning when used in this\r\nnotice.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">Information We\r\nCollect<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">We\r\ncollect information that identifies, relates to, describes, references, is\r\ncapable of being associated with, or could reasonably be linked, directly or\r\nindirectly, with a particular consumer or device i.e., you (“personal\r\ninformation”)<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Boom\r\nJournal does not “sell” personal information and has not “sold” personal\r\ninformation relating to California residents, including within the meaning of\r\nthe CCPA within the past 12 months. For purposes of this Disclosure, “sell” or\r\n“sold” means the disclosure of personal information for monetary or other\r\nvaluable consideration.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">We\r\nhave collected the following categories of personal information from consumers\r\nwithin the last twelve (12) months:<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Data\r\nProcessing Recap<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Please,\r\nnote that personal information does not include:<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l8 level1 lfo3;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Publicly available information from government records.<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l8 level1 lfo3;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">De-identified or aggregated consumer information.<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l8 level1 lfo3;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Information excluded from the CCPA\'s scope, like:/li&gt;<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l8 level1 lfo3;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">health or medical information covered by the Health Insurance\r\nPortability and Accountability Act of 1996 (HIPAA) and the California\r\nConfidentiality of Medical Information Act (CMIA) or clinical trial data;<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l8 level1 lfo3;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">personal information covered by certain sector-specific privacy\r\nlaws, including the Fair Credit Reporting Act (FRCA), the Gramm-Leach-Bliley\r\nAct (GLBA) or California Financial Information Privacy Act (FIPA), and the\r\nDriver\'s Privacy Protection Act of 1994.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">We\r\nobtain the categories of personal information listed above from the following\r\ncategories of sources:<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l2 level1 lfo4;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Directly from our users. For example, from documents that you\r\nprovide to us related to our Services.<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l2 level1 lfo4;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Indirectly from our users. For example, through information we\r\ncollect from you in the course of providing Services to you.<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l2 level1 lfo4;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Directly and indirectly from activity on our App. For example,\r\nfrom your moods or activities you enter.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">For\r\nmore information, please refer to section 3 **“**What Personal Information do\r\nwe process about you? ” of our general Privacy Policy.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">Use Of\r\nPersonal Information<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">The\r\nbusiness purposes for which Boom uses personal information depends on the\r\nrelationship or interaction with a specific California resident, and we only\r\nprocess your information for purposes permitted by applicable laws.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">We\r\noutline in detail under section 4 of our Privacy Policy, “Why and How do we\r\nprocess Personal Information about you?” the purposes of the processing\r\npersonal information.<o:p></o:p></span></p>\r\n\r\n<h6 style=\"margin: 0in 0in 16.5pt; line-height: 17.25pt; text-transform: capitalize;\"><b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\">Examples Include:</span></b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\"><o:p></o:p></span></h6>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l5 level1 lfo5;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:12.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Managing Boom Journal’s relationship with you;</span><span style=\"font-size:12.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\"><o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l5 level1 lfo5;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">To follow-up with your feedbacks;<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l5 level1 lfo5;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">To allow the use of the app in all its functionalities such as\r\nthe filling of your journal around your mood or location of your photos; etc.<o:p></o:p></span></p>\r\n\r\n<h6 style=\"margin: 0in 0in 16.5pt; line-height: 17.25pt; text-transform: capitalize;\"><b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\">Sharing Personal Information</span></b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\"><o:p></o:p></span></h6>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">We\r\nmay disclose your personal information to a third party for a business purpose.\r\nWhen we disclose personal information for a business purpose, we enter a\r\ncontract that describes the purpose and requires the recipient to both keep\r\nthat personal information confidential and not use it for any purpose except\r\nperforming the contract.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">In\r\nthe preceding twelve (12) months, we have disclosed the following categories of\r\npersonal information for a business purpose:<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l3 level1 lfo6;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Personal Identifiers<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l3 level1 lfo6;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Protected classification characteristics under California or\r\nfederal law<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l3 level1 lfo6;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Commercial information<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l3 level1 lfo6;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Biometric information<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l3 level1 lfo6;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Internet or other similar network activity<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l3 level1 lfo6;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Geolocation data<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l3 level1 lfo6;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Inferences drawn from other personal information<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Boom\r\ndiscloses your personal information only in accordance with local applicable\r\nlaws and regulations, and appropriate safeguards will be established, where possible,\r\nto protect your information. Boom journal may disclose personal information to\r\nany member of our group of companies We disclose your personal information for\r\na business purpose to the following categories of third parties:<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l9 level1 lfo7;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Agents, Consultants, and Related Third Parties<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l9 level1 lfo7;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Business partners and service providers<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l9 level1 lfo7;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Corporate Restructurers<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l9 level1 lfo7;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Payment processor<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l9 level1 lfo7;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Boom Journal affiliates<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l9 level1 lfo7;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Third parties to whom you or your agents authorize us to\r\ndisclose your personal information in connection with products or services we\r\nprovide to you<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">In\r\nthe preceding twelve (12) months, we have not sold any personal information.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">The\r\nsharing of your personal information is outlined in further detail under\r\nsection 6 of our Privacy Policy, Do we disclose your Personal Information? ”<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">Your Rights\r\nAnd Choices<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">The\r\nCCPA provides you (California residents) with specific rights regarding their\r\npersonal information. This section describes your CCPA rights and explains how\r\nto exercise those rights.<o:p></o:p></span></p>\r\n\r\n<h6 style=\"margin: 0in 0in 16.5pt; line-height: 17.25pt; text-transform: capitalize;\"><b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\">Access To Specific Information\r\nAnd Data Portability Rights</span></b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\"><o:p></o:p></span></h6>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">You\r\nhave the right to access certain information to you about our collection and\r\nuse of your personal information over the past 12 months. Once we receive and\r\nconfirm identity, we will disclose to you:<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l7 level1 lfo8;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">The categories of personal information we collected about you.<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l7 level1 lfo8;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">The categories of sources for the personal information we\r\ncollected about you.<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l7 level1 lfo8;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Our business or commercial purpose for collecting that personal\r\ninformation.<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l7 level1 lfo8;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">The categories of third parties with whom we share that personal\r\ninformation.<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l7 level1 lfo8;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">The specific pieces of personal information we collected about\r\nyou (also called a data portability request).<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l7 level1 lfo8;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">If we sold or disclosed your personal information for a business\r\npurpose, two separate lists disclosing:<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l7 level1 lfo8;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">sales, identifying the personal information categories that each\r\ncategory of recipient purchased; and<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l7 level1 lfo8;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">disclosures for a business purpose, identifying the personal\r\ninformation categories that each category of recipient obtained.<o:p></o:p></span></p>\r\n\r\n<h6 style=\"margin: 0in 0in 16.5pt; line-height: 17.25pt; text-transform: capitalize;\"><b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\">Deletion Request Rights</span></b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\"><o:p></o:p></span></h6>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">You\r\nhave the right to request that we delete any of your personal information that\r\nwe collected from you and retained, subject to certain exceptions. Once we\r\nreceive and confirm your identity, we will delete (and direct our service\r\nproviders to delete) your personal information from our records, unless an\r\nexception applies.<o:p></o:p></span></p>\r\n\r\n<h6 style=\"margin: 0in 0in 16.5pt; line-height: 17.25pt; text-transform: capitalize;\"><b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\">Authorized Agents</span></b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\"><o:p></o:p></span></h6>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">You\r\nhave the right to designate an authorized agent to act on your behalf to\r\nexercise your rights under the CCPA. In order to do so, Boom journal must\r\nverify your identity, and your authorized agent must have written permission\r\nfrom you. We reserve the right to deny a request from an agent that does not\r\nsubmit proof that they are authorized to act on your behalf.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">Exercising\r\nAccess, Data Portability, And Deletion Rights<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">To\r\nexercise the access, data portability, and deletion rights described above,\r\nplease submit a verifiable consumer request to us by either.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Sending\r\nus an email at hello@iammattwest.com<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Only\r\nyou or a person registered with the California Secretary of State that you\r\nauthorize to act on your behalf, may make a verifiable consumer request related\r\nto your personal information. You may also make a verifiable consumer request\r\non behalf of your minor child.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">You\r\nmay only make a verifiable consumer request for access or data portability\r\ntwice within a 12-month period. The verifiable consumer request must:<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l6 level1 lfo9;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Provide sufficient information that allows us to reasonably\r\nverify you are the person about whom we collected personal information or an\r\nauthorized representative.<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l6 level1 lfo9;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Describe your request with sufficient detail that allows us to\r\nproperly understand, evaluate, and respond to it<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">We\r\ncannot respond to your request or provide you with personal information if we\r\ncannot verify your identity or authority to make the request and confirm the\r\npersonal information relates to you. Making a verifiable consumer request does\r\nnot require you to create an account with Boom journal. We will only use\r\npersonal information provided in a verifiable consumer request to verify the\r\nrequestor\'s identity or authority to make the request.<o:p></o:p></span></p>\r\n\r\n<h6 style=\"margin: 0in 0in 16.5pt; line-height: 17.25pt; text-transform: capitalize;\"><b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\">Response Timing And Format</span></b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\"><o:p></o:p></span></h6>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">We\r\nendeavor to respond to a verifiable consumer request within 45 days of its\r\nreceipt. If we require more time (up to 90 days), we will inform you of the\r\nreason and extension period in writing. We will deliver our written response by\r\nmail or electronically, at your option. Any disclosures we provide will only\r\ncover the 12-month period preceding the verifiable consumer request\'s receipt.\r\nThe response we provide will also explain the reasons we cannot comply with a\r\nrequest, if applicable. For data portability requests, we will select a format\r\nto provide your personal information that is readily useable and should allow\r\nyou to transmit the information from one entity to another entity without\r\nhindrance.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">We\r\ndo not charge a fee to process or respond to your verifiable consumer request\r\nunless it is excessive, repetitive, or manifestly unfounded. If we determine\r\nthat the request warrants a fee, we will tell you why we made that decision and\r\nprovide you with a cost estimate before completing your request.<o:p></o:p></span></p>\r\n\r\n<h6 style=\"margin: 0in 0in 16.5pt; line-height: 17.25pt; text-transform: capitalize;\"><b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\">Consumers With Disabilities</span></b><span style=\"font-size: 15pt; font-family: Arial, &quot;sans-serif&quot;;\"><o:p></o:p></span></h6>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Boom\r\nstrives to accommodate all users regardless of disabilities. If you need to\r\nreceive the information contained in this document in a different format,\r\nplease contact us using the contact information listed below.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">Non-Discrimination<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">We\r\nwill not discriminate against you for exercising any of your CCPA rights.\r\nUnless permitted by the CCPA, we will not:<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l0 level1 lfo10;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Deny you our Services.<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l0 level1 lfo10;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Charge you different prices or rates for goods or services,\r\nincluding granting discounts or other benefits, or imposing penalties.<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l0 level1 lfo10;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Provide you a different level or quality of Services.<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt:auto;margin-bottom:15.0pt;\r\nmargin-left:0in;text-indent:-.25in;line-height:22.5pt;mso-list:l0 level1 lfo10;\r\ntab-stops:list .5in\"><!--[if !supportLists]--><span style=\"font-size:10.0pt;\r\nmso-bidi-font-size:11.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;\r\nmso-bidi-font-family:Symbol;color:#393939\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;\r\ncolor:#393939\">Suggest that you may receive a different price or rate for\r\nservices or a different level or quality of goods or services.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">Changes To Our\r\nCalifornia Consumer Information<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">We\r\nmay revise from time to time our California Consumer Information, and we will\r\nreview it at least each year. Suppose we make any material changes to our\r\nCalifornia Consumer Information. In that case, we will post updates on the\r\nService: we will post the new Information on the Website and its App with a new\r\neffective date to notify you of these changes and/or we will notify you by\r\nsending you an email or other notification as required by applicable law (the\r\n“Modifications”). Modifications will apply to all current and past users of the\r\nServices as of its effective date and will replace any prior policies. In\r\naddition, by accessing the Services on or after the effective date, you are\r\ndeemed to consent to our then-current Modifications.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">Please\r\nreview this California Consumer Information periodically for changes, and\r\nespecially before you provide any Personal Information. If Modifications to\r\nthis Privacy Policy are not acceptable to you, you should cease accessing,\r\nbrowsing, and otherwise using the Service.<o:p></o:p></span></p>\r\n\r\n<h4 style=\"margin: 0in 0in 15pt; line-height: 21.75pt; text-transform: capitalize;\"><span style=\"font-size: 19.5pt; font-family: Arial, &quot;sans-serif&quot;;\">Contact\r\nInformation<o:p></o:p></span></h4>\r\n\r\n<p style=\"margin: 0in 0in 15pt; line-height: 22.5pt;\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#393939\">If\r\nyou have any questions or comments about this notice. In that case, the ways in\r\nwhich we collect and use your personal information, your choices and rights\r\nregarding such use, or wish to exercise your rights under California law,\r\nplease do not hesitate to contact us at: hello@boomjournal.com.</span></p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-10 12:58:35', '2022-07-26 02:06:52', 'Privacy Section', 1);
INSERT INTO `contents` (`id`, `page_name`, `title`, `subtitle`, `description`, `description2`, `image_path`, `title1`, `text1`, `image1`, `title2`, `text2`, `image2`, `title3`, `text3`, `image3`, `title4`, `image4`, `text4`, `title5`, `image5`, `text5`, `title6`, `image6`, `text6`, `button1`, `button1link`, `button2`, `button2link`, `button3`, `button3link`, `button4`, `button4link`, `phone1`, `phone2`, `created_at`, `updated_at`, `deleted_at`, `page_section`, `status`) VALUES
(33, 'Home Page', 'About Us', NULL, '<p style=\"margin-bottom: 30.9531px; font-family: Roboto; line-height: 25px; font-size: 17px;\">ClovesRX Global is a full-service prescription delivery company that offers safe and secure delivery for all types of medications to patients around southern California. We have the solution for your on-time prescription delivery challenges, since we take all precautions necessary to deliver the medications to patients on time. No matter the type of prescription, we have the right experience to deliver them whenever and whenever your customers require it.</p><p style=\"margin-bottom: 30.9531px; font-family: Roboto; line-height: 25px; font-size: 17px;\">Being a faith-based entity, our mission is to serve our community. We believe by delivering needed medications on time, we are servicing the people of God and fulfilling His commandants.</p><p style=\"margin-bottom: 30.9531px; font-family: Roboto; line-height: 25px; font-size: 17px;\">Why wait? Let us help your pharmacy connect with the right healthcare centers and individuals, and together we can serve our community.</p>', NULL, NULL, NULL, '<p style=\"margin-bottom: 30.9531px; font-family: Roboto; line-height: 25px; font-size: 17px;\">ClovesRX Global is a full-service prescription delivery company that offers safe and secure delivery for all types of medications to patients around southern California. We have the solution for your on-time prescription delivery challenges, since we take all precautions necessary to deliver the medications to patients on time. No matter the type of prescription, we have the right experience to deliver them whenever and whenever your customers require it.</p><p style=\"margin-bottom: 30.9531px; font-family: Roboto; line-height: 25px; font-size: 17px;\">Being a faith-based entity, our mission is to serve our community. We believe by delivering needed medications on time, we are servicing the people of God and fulfilling His commandants.</p><p style=\"margin-bottom: 30.9531px; font-family: Roboto; line-height: 25px; font-size: 17px;\">Why wait? Let us help your pharmacy connect with the right healthcare centers and individuals, and together we can serve our community.</p>', 'uploads/admin/CMS/16655921721.png', NULL, NULL, 'uploads/admin/CMS/16655929312.png', NULL, NULL, 'uploads/admin/CMS/16655929313.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'REQUEST DELIVERY SERVICE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-12 11:42:11', NULL, 'About Us Section', 1),
(34, 'Counter', '98.5K', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore', NULL, NULL, '99K', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore', NULL, '13.7K', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore', NULL, '90P', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-22 18:20:44', '2022-07-26 02:07:20', 'Counter Section', 1),
(35, 'FAQS', 'OUR FREQUENTLY ASKED QUESTIONS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-19 19:39:32', '2022-10-09 23:29:15', NULL, 'FAQS', 1),
(36, 'About Us', 'How ClovesRx Works?', NULL, '<p style=\"font-family: Roboto; line-height: 30px; font-size: 18px;\">1. Call us for a medication pick up.</p><p style=\"font-family: Roboto; line-height: 30px; font-size: 18px;\">2. Provide us the name and address.</p><p style=\"font-family: Roboto; line-height: 30px; font-size: 18px;\">3. We deliver your order.</p>', NULL, 'uploads/admin/CMS/16654360461.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-10 16:07:26', NULL, 'How it works Section', 1),
(37, 'About Us', 'CERTIFICATIONS and MEMBERSHIPS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-13 17:25:38', NULL, 'Certifications and Memberships Section', 1),
(38, 'Home Page', 'Services We Provide', NULL, 'Our service caters to the prescription delivery needs of independent pharmacies across Southern California.', NULL, 'uploads/admin/CMS/16654470981.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-10 19:34:32', NULL, 'Services Section', 1),
(39, 'Home Page', 'Why Choose Us', NULL, 'We are a committed team of professionals focused on providing excellent Rx delivery services to our customers.', NULL, 'uploads/admin/CMS/16655937081.png', 'Local Expertise', 'With years of experience working in the pharmaceutical industry, our professionals understand the needs and requirements of today’s busy pharmacies.', 'uploads/admin/CMS/16654511631.png', 'Fast Delivery', 'We understand the importance of getting meds delivered on time, which is why we promise fast and convenient delivery anywhere you need.', 'uploads/admin/CMS/16654511632.png', 'Tailored To You', 'We value each of our partners and take pride in providing them services based on their needs and requirements.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-13 15:16:58', NULL, 'Why Choose Us Section', 1),
(40, 'Home Page', 'OUR FREQUENTLY ASKED QUESTIONS', NULL, 'Find out what pharmacies and individuals are asking us frequently.', NULL, 'uploads/admin/CMS/16656026141.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'VIEW ALL FAQS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-13 15:21:19', NULL, 'FAQS Section', 1),
(41, 'Home Page', 'Partners', NULL, NULL, NULL, 'uploads/admin/CMS/16654947471.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-11 08:25:47', NULL, 'Partner Section', 1),
(42, 'Home Page', 'Locations We Serve Currently', NULL, NULL, NULL, 'uploads/admin/CMS/16782309121.png', 'Riverside', NULL, NULL, 'Moreno Valley', NULL, NULL, 'Corona', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-07 18:15:12', NULL, 'Location Section', 1),
(43, 'About Us', 'Locations We Serve Currently', NULL, NULL, NULL, 'uploads/admin/CMS/16657000871.png', 'Riverside', NULL, NULL, 'Moreno Valley', NULL, NULL, 'Corona', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-13 17:28:07', NULL, 'Location Section', 1),
(44, 'Home Page', 'CERTIFICATIONS and MEMBERSHIPS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-13 17:25:38', NULL, 'Certifications and Memberships Section', 1),
(45, 'Home Page', 'Helping Pharmacies Deliver On Time', NULL, 'Let us deliver your prescription, and together we can improve lives.', NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-13 16:10:52', NULL, 'Document Section', 1),
(46, 'Terms & Conditions', 'Terms And Conditions', NULL, '<span style=\"color: rgb(57, 57, 57); font-family: Poppins, sans-serif; font-size: 15px;\">Welcome to Website Name! These terms and conditions outline the rules and regulations for the use of Company Name\'s Website, located at Website.com. By accessing this website we assume you accept these terms and conditions. Do not continue to use Website Name if you do not agree to take all of the terms and conditions stated on this page. The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: “Client”, “You” and “Your” refers to you, the person log on this website and compliant to the Company\'s terms and conditions. “The Company”, “Ourselves”, “We”, “Our” and “Us”, refers to our Company. “Party”, “Parties”, or “Us”, refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client\'s needs in respect of provision of the Company\'s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.</span>', NULL, NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-13 18:47:51', NULL, 'Terms & Conditions', 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_request`
--

CREATE TABLE `delivery_request` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `pharmacy_name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `deliver_to` varchar(255) DEFAULT NULL,
  `daily_delivery` varchar(255) DEFAULT NULL,
  `delivery_destination` text DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `street_line` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `postal` varchar(255) DEFAULT NULL,
  `medicine_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_request`
--

INSERT INTO `delivery_request` (`id`, `first_name`, `last_name`, `name`, `organization`, `pharmacy_name`, `address`, `title`, `email`, `phone`, `message`, `deliver_to`, `daily_delivery`, `delivery_destination`, `street_address`, `street_line`, `city`, `region`, `postal`, `medicine_name`, `description`, `time`, `created_at`, `updated_at`, `deleted_at`) VALUES
(26, NULL, NULL, 'Cassidy Pope', NULL, 'Alfonso Doyle', 'Fugiat sequi illum', NULL, NULL, '151-411-6101', NULL, 'Iste quis molestiae', 'Dolore libero iusto', 'Voluptatibus deserun', NULL, NULL, NULL, NULL, NULL, NULL, 'Qui id dolore aute u', 'Nam amet voluptate', '2022-10-21 14:56:41', '2022-10-21 14:56:41', NULL),
(27, 'Xandra', 'Roberts', NULL, 'Grimes Prince Co', NULL, NULL, 'Dolor velit exercit', 'tabi@mailinator.com', '184-925-9388', 'Officiis perspiciati', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-21 14:57:41', '2022-10-21 14:57:41', NULL),
(28, 'Mack', 'Joy', NULL, 'abc', NULL, NULL, 'asdf', 'admin@lrty.com', '453-453-4534', 'adf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-21 15:49:40', '2022-10-21 15:49:40', NULL),
(29, 'Fulton', 'Madden', NULL, 'Ford Mullen Associates', NULL, NULL, 'Accusamus adipisicin', 'bilukysiw@mailinator.com', '187-125-8102', 'Assumenda at sit cum', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-21 17:32:17', '2022-10-21 17:32:17', NULL),
(30, 'Unity', 'Hinton', NULL, 'Prince and Mcbride Traders', NULL, NULL, 'Et modi sint pariatu', 'tije@mailinator.com', '110-316-9650', 'Magna magna repudian', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-25 11:33:46', '2022-10-25 11:33:46', NULL),
(31, 'Devin', 'Hodges', NULL, 'Mckee and Cole Plc', NULL, NULL, 'Voluptatum vero vero', 'mulocym@mailinator.com', '158-641-4877', 'Excepturi laboris vo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-25 11:46:58', '2022-10-25 11:46:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `upload_file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `upload_file`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, 'uploads/admin/Doc/1665517218.docx', '2022-10-11 14:40:18', '2022-10-11 19:40:18', NULL),
(15, 'uploads/admin/Doc/1665524048.docx', '2022-10-11 16:34:08', '2022-10-11 21:34:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `excel_path`
--

CREATE TABLE `excel_path` (
  `id` int(11) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `excel_path`
--

INSERT INTO `excel_path` (`id`, `file_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(NULL, 'uploads/admin/Doc/1678498431.xlsx', '2023-03-10 20:33:51', '2023-03-11 01:33:51', NULL),
(NULL, 'uploads/admin/Doc/1678498453.xlsx', '2023-03-10 20:34:13', '2023-03-11 01:34:13', NULL),
(NULL, 'uploads/admin/Doc/1678498468.xlsx', '2023-03-10 20:34:28', '2023-03-11 01:34:28', NULL),
(NULL, 'uploads/admin/Doc/1678498528.xlsx', '2023-03-10 20:35:28', '2023-03-11 01:35:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted-at` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`, `deleted-at`, `status`) VALUES
(1, 'Are you a pharmacy?', 'No. We are a company that help pharmacies deliver medications to their customers.', '2022-10-10 04:05:12', '2022-10-09 23:05:12', NULL, 1),
(3, 'where do you deliver to?', 'We currently offer prescription pharmacy and prescription delivery services to Riverside, Corona, and Moreno Valley.', '2022-10-09 23:15:48', '2022-10-09 23:15:48', NULL, 1),
(4, 'How much does it cost?', 'This entirely depends on the type of service you require and the delivery distance. Contact our team for more information.', '2022-10-12 15:54:00', '2022-10-12 15:54:00', NULL, 1),
(5, 'What makes you service special?', 'We are a prescription delivery company that values a positive relationship with our partners. Not only that, we are always willing to go the extra mile to meet the needs of the community that we serve.', '2022-10-12 16:13:12', '2022-10-12 16:13:12', NULL, 1),
(6, 'How does the delivery work?', 'A partner pharmacy needs to contact us and give us the required information for making a delivery. Our team will then pick up and drop off the medications for them as per their requested service.', '2022-10-13 15:59:56', '2022-10-13 15:59:56', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `imagetable`
--

CREATE TABLE `imagetable` (
  `id` int(11) NOT NULL,
  `table_name` varchar(50) DEFAULT NULL,
  `img_path` text DEFAULT NULL,
  `img_href` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ref_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT 1,
  `is_active_img` varchar(1) DEFAULT '1',
  `additional_attributes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `imagetable`
--

INSERT INTO `imagetable` (`id`, `table_name`, `img_path`, `img_href`, `created_at`, `updated_at`, `ref_id`, `type`, `is_active_img`, `additional_attributes`) VALUES
(2, 'logo', 'uploads/imagetable/1665591928.png', NULL, '2022-10-12 16:25:28', '2022-10-12 11:25:28', NULL, 1, '1', NULL),
(3, 'favicon', 'uploads/imagetable/1665606108.png', NULL, '2022-10-12 20:21:48', '2022-10-12 15:21:48', NULL, 1, '1', NULL),
(4, 'logo2', 'uploads/imagetable/1654032295.png', NULL, '2022-05-31 21:24:55', '2022-05-31 16:24:55', NULL, 1, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `access_token` text DEFAULT NULL,
  `update_token` varchar(255) DEFAULT NULL,
  `refresh_token` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `access_token`, `update_token`, `refresh_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'eyJlbmMiOiJBMTI4Q0JDLUhTMjU2IiwiYWxnIjoiZGlyIn0..OsbUKTNK71nSKTm6psnfPg.Hm6qrQPpE_0JyXxnj97DSNtg5PktHjuX2Ulmd6LCY7G0NzCZcDUPO71-Ifre3S1Ch7v3OpDEWZLFFrTaKyK3QSa3XsC0B3jYDuZfkiiJmg4tZpmgQVD_0w_E6nLsZkccBQ1wtMgmmq-4FXQ2woKReWQIeczQAnvwilBgrF885cjCzpTw706DzJ0LyEepCRfVeqR7g-GXgqWDlL8ANPgcGOW7D-30eu9GVxIdK3UZuRKxb16TMSfCgK2oBoWHaRxUf-LGAA-wVd2D-xHlZFnpQdoDxJ28QxzDcC43B20Y7V9rUZSoTc53pfQhlS7eR8wBIIx3DJFBrJvmL9YzIZvK_-AlCgIZ0Tvber7BKlCxX6plO3ceO7opNzZIu-iZ3sNtSbC_8paRrDhAghHTEuBFvP6-kc_XxmqvM-nXESNG9OUjTtNnMTwCNnY3Xwrj9cFFRi6WWptVkuNEmc29KHnoDT3fIL_GGgUsK2fu80YNOVXrZX1yC0xBm2cD0TpE7KzM1s8ofvSQ1AzAZddNKKhFY8vv1igD3yM6EaJox3d0Kx7dgeeAlAhKab0trq842blB4LSy_52yoRI2Omj9BDfshP1TBQnzd-lblye83hlncyUGMqx6IKqgbcuNGSHCrA_ssqHsJIelSGgjfHnVxZLfzqqQHCz6eXbdA6RFhEQTWJpwdXhGuN9b3yEfFmqDzwdBHZLMFPgTCrOgWWH_VVf2RPkFiKUkShZKqyDk3bvCLzEFPHc-5JGrSw0kt1N8-Apr.TPzqRhdkkToKPPqS-jLncQ', NULL, 'AB11678735366u2zew0SaiRPILUsKTNTGIlMzHprEwceXZKTPV', '2022-12-02 14:22:46', '2022-12-02 19:22:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Corona', '2022-10-11 17:37:54', '2022-10-11 17:37:54', NULL),
(3, 'Moreno Valley', '2022-10-11 17:38:07', '2022-10-11 17:38:07', NULL),
(4, 'Riverside', '2022-10-11 17:42:42', '2022-10-11 17:42:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `main_banner`
--

CREATE TABLE `main_banner` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `testimonial_title` varchar(255) DEFAULT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `image4` varchar(255) DEFAULT NULL,
  `image5` varchar(255) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `reviews` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main_banner`
--

INSERT INTO `main_banner` (`id`, `title`, `image_path`, `description`, `testimonial_title`, `image1`, `image2`, `image3`, `image4`, `image5`, `rating`, `reviews`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'Serving People of God', 'uploads/admin/MainBanner/1665368699.png', 'We are a faith-based prescription delivery service with a primary purpose to serve mankind and God.', 'Our Happy Customers', 'uploads/admin/MainBanner/16656034451.png', 'uploads/admin/MainBanner/16656034452.png', 'uploads/admin/MainBanner/16656034453.png', 'uploads/admin/MainBanner/16656034454.png', NULL, '5', '12.5k', '2022-10-14 00:23:10', '2022-10-12 19:37:25', NULL, 1),
(2, 'Medication Delivered on time', 'uploads/admin/MainBanner/1665600091.png', 'Our company considers itself as an extension of your business and puts all possible efforts into providing quick and accurate delivery of your prescription items.', 'Our Happy Customers', 'uploads/admin/MainBanner/16656034871.png', 'uploads/admin/MainBanner/16656034872.png', 'uploads/admin/MainBanner/16656034873.png', 'uploads/admin/MainBanner/16656034874.png', NULL, '5', '12.5k', '2022-10-14 00:23:12', '2022-10-12 19:38:07', NULL, 1),
(3, 'Prescription Pick Up & Delivery', 'uploads/admin/MainBanner/1665616368.png', 'Let us deliver medications to your customers’ doorstep and relieve you from managing deliveries on your own.', 'Our Happy Customers', 'uploads/admin/MainBanner/16656033441.png', 'uploads/admin/MainBanner/16656033442.png', 'uploads/admin/MainBanner/16656033443.png', 'uploads/admin/MainBanner/16656033444.png', NULL, '5', '12.5k', '2022-10-14 00:22:43', '2022-10-14 00:20:16', NULL, 1),
(4, 'Your Prescription Delivery Partner', 'uploads/admin/MainBanner/1665706916.png', 'We are to help independent pharmacies deliver prescriptions to patients safely and securely around Southern California.', 'Our Happy Customers', 'uploads/admin/MainBanner/16656034071.png', 'uploads/admin/MainBanner/16656034072.png', 'uploads/admin/MainBanner/16656034073.png', 'uploads/admin/MainBanner/16656034074.png', 'uploads/admin/MainBanner/16657069165.png', '5', '12.5k', '2022-10-14 00:22:29', '2022-10-14 00:21:56', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`id`, `description`, `link`, `image_path`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(6, 'MEMBERS OF THE CORONA CHAMBERS OF COMMERCE', 'HTTPS://WWW.MYCHAMBER.ORG/', 'uploads/admin/Membership/16654899681.png', '2022-10-14 22:02:38', '2022-10-14 17:02:38', NULL, 1),
(7, 'MINORITY BUSINESS ENTERPRISE (MBE) CERTIFICATION WITH THE SOUTHERN CALIFORNIA MINORITY SUPPLIER DEVELOPMENT COUNCIL (SCMSDC)', 'HTTPS://WWW.SCMSDC.ORG/', 'uploads/admin/Membership/16654899461.png', '2022-10-14 22:01:42', '2022-10-14 17:01:42', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_flag`
--

CREATE TABLE `m_flag` (
  `id` int(11) NOT NULL,
  `flag_type` varchar(100) NOT NULL,
  `flag_value` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `placeholder` varchar(255) NOT NULL,
  `flag_additionalText` text DEFAULT NULL,
  `has_image` varchar(1) DEFAULT '0',
  `is_active` varchar(1) DEFAULT '1',
  `is_config` varchar(1) DEFAULT '0',
  `flag_show_text` text DEFAULT NULL,
  `is_featured` int(11) DEFAULT 0,
  `is_deleted` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `m_flag`
--

INSERT INTO `m_flag` (`id`, `flag_type`, `flag_value`, `created_at`, `updated_at`, `placeholder`, `flag_additionalText`, `has_image`, `is_active`, `is_config`, `flag_show_text`, `is_featured`, `is_deleted`, `user_id`) VALUES
(49, 'NEWSLETTER_TEXT', 'Stay updated with our latest trends Seed heaven so said place winged over given forth fruit.', '2022-10-08 13:09:24', '2022-08-22 15:55:51', 'Newsletter Text', 'Stay updated with our latest trends Seed heaven so said place winged over given forth fruit.', '0', NULL, NULL, 'NEWSLETTER TEXT', 0, 0, 0),
(50, 'EMAIL1', 'ClovesRX@Clovesrx.Com', '2022-10-10 17:24:47', '2022-10-08 08:03:46', 'abc@gmail.com', 'ClovesRX@Clovesrx.Com', '0', '1', '1', 'Email', 0, 0, 0),
(51, 'EMAIL2', 'info@lormeipsum.com', '2022-10-10 17:30:06', '2022-10-10 12:30:06', 'abc@gmail.com', 'info@lormeipsum.com', '0', '1', '1', 'Email', 0, 0, 0),
(52, 'PHONE1', '+951-732-5121', '2022-10-10 17:30:41', '2022-10-10 12:30:41', '623-889-5530', '+951-732-5121', '0', '1', '1', 'OFFICE', 0, 0, 0),
(54, 'PHONE2', '+123 123363114', '2022-10-10 17:30:41', '2022-10-10 12:30:41', '623-889-5530', '+123 123363114', '0', '1', '1', 'FAX', 0, 0, 0),
(55, 'DOCUMENT_TEXT', 'Let us deliver your prescription, and together we can improve lives.', '2022-10-13 21:32:20', '2022-10-13 16:07:44', '', 'Let us deliver your prescription, and together we can improve lives.', '0', NULL, NULL, 'DOCUMENT_TEXT', 0, 0, 0),
(56, 'ADDRESS', '765 North Main Street STE 143 Corona, CA 92878', '2022-10-10 17:24:42', '2022-10-08 08:05:37', 'Address', '765 North Main Street STE 143 Corona, CA 92878', '0', '1', '1', 'Address', 0, 0, 0),
(58, 'FOOTER_TEXT', 'ClovesRX Global is a full-service prescription delivery company that offers safe and secure delivery for all types of medications to patients around southern California.', '2022-10-08 13:08:05', '2022-10-08 08:08:05', 'Footer Text', 'ClovesRX Global is a full-service prescription delivery company that offers safe and secure delivery for all types of medications to patients around southern California.', '0', '1', '1', 'FOOTER TEXT', 0, 0, 0),
(59, 'COPYRIGHT', '© 2022 - ALL RIGHTS RESERVED', '2022-10-13 20:30:33', '2022-10-13 15:30:33', 'Copyright', '© 2022 - ALL RIGHTS RESERVED', '0', '1', '1', 'Copyright', 0, 0, 0),
(60, 'GOOGLE', 'https://plus.google.com', '2022-10-10 17:31:01', '2022-10-10 12:31:01', '', 'https://plus.google.com', '0', '1', '1', 'GOOGLE', 0, 0, 0),
(123, 'COMPANYURL', 'Free Shipping', '2022-02-01 21:33:11', '0000-00-00 00:00:00', '', 'Free Shipping', '0', NULL, '0', 'Shipping', 0, 0, 0),
(682, 'FACEBOOK', 'https://www.facebook.com', '2022-08-22 21:26:11', '2022-08-22 16:26:11', 'Facebook link', 'https://www.facebook.com', '1', '1', '1', 'Facebook', 0, 0, 0),
(1960, 'TWITTER', 'https://twitter.com', '2022-08-22 21:26:12', '2022-08-22 16:26:12', 'Twitter link', 'https://twitter.com', '1', '1', '1', 'Twitter', 0, 0, 0),
(1961, 'PINTEREST', 'https://www.pinterest.com/', '2022-05-18 19:29:11', '0000-00-00 00:00:00', '', 'https://www.pinterest.com/', '0', '0', '0', 'Pinterest', 0, 0, 0),
(1962, 'INSTAGRAM', 'https://www.instagram.com', '2022-08-22 21:26:12', '2022-08-22 16:26:12', 'Instagram link', 'https://www.instagram.com', '1', '1', '1', 'Instagram', 0, 0, 0),
(1963, 'LinkedIn', 'https://www.linkedin.com/', '2022-10-08 13:10:49', '2022-10-08 08:10:49', '', 'https://www.linkedin.com/', '0', '1', '1', 'Linkedin', 0, 0, 0),
(1964, 'Youtube', 'https://www.youtube.com/channel/UCLPGU6tjUl_DCiwAK8vvTXQ', '2022-08-18 23:10:58', '2022-08-09 18:21:25', '', 'https://www.youtube.com/channel/UCLPGU6tjUl_DCiwAK8vvTXQ', '0', NULL, NULL, 'Youtube', 0, 0, 0),
(1965, 'APP NAME', 'HEALTH-CARE', '2022-05-23 17:00:10', '0000-00-00 00:00:00', '', 'HEALTH-CARE', '0', '0', '0', 'Whatsapp Number', 0, 0, 0),
(1966, 'QUICKBOOK_ACCESS_TOKEN', 'eyJlbmMiOiJBMTI4Q0JDLUhTMjU2IiwiYWxnIjoiZGlyIn0..5E6LsVRDjcbG0NLh74phFg.ztkVlSIcXH5hZxZKDw1qrddI45Mzz-Doebv6QgmDw1hmFj5kgTR3ulMrfrDS2peHgy5XC8TB7Cz4Wx0KtI7QZl-8UxqSTPTCM3Bo-zromlkyablgWMD7tkl-0e0HJJTv6pQIhV0XoXxTh4joS6ebZrX_S54G2TV6SGBvmCfrON3wHiMWPKB9QeCuX4TL5bG46oFFt9dFVNDYMrEtb9Dmf3ge334nyky1KTzkdgZ7o8wapCGeydBM2v2VCLtdWxFxqX5ssE1HwzBsR__NUY3X2-4uo-DsLnEAbteeTm9iZ0Wyy9O5LcY9-wWpRZ6_f6HXl5AbkkLY5RzaBHJh7CFynogg2F2HK7-ivsAWcdQjLnZDagpJxsAVN4CsNj8LmI2A6TUZ93MsuksU3FBaChHHK8__jZ_rUmnfBHCL-aCoo9t0g5yUyNhsgwdLTNf8tGkFqliVp0gXEOwzyy6zlC0tYOTJcGlbxVM4UJfzwk6_qrWk2Yqkay0cPMQ2r7ebODOeDSVLU0wijduueIJUqYhIhRlnEbG8OVtweGNvi4RskNQ-dv-mbELYAYXG-XcM3Cg5vs740B1NdJm6TeOye9PIiMH5-3nGd8bH--_BMiWa7aVAgIsBwe7Y4VdZdh2FSjXEDFnWWsLAInAxXlZN9U9w6Ss4tVaXZAbzoa4SswCHf11k5beShvEhb7SHRB-rjcoOqFao9hResfg57IL2gRnatsKtG88hXgjyns3NVGoRkTWrKgBXHcX1VmvqGbEjGZKn.s5GrC_sZjLVfWnHIwb-UOw', '2023-02-28 18:02:11', '2023-02-28 13:02:11', '', NULL, '0', '0', '0', 'GOOGLE MAP', 0, 0, 0),
(1967, 'QUICKBOOK_REFRESH_TOKEN', 'AB11686332809iEqPwBwDhSHfBScFPVGI0xr6iajAKwWZsgbvj', '2023-02-28 17:46:50', '2023-02-28 12:46:50', '', NULL, '0', NULL, NULL, 'Header Line', 0, 0, 0),
(1968, 'QUICKBOOK_REAL_MID', '4620816365266887540', '2023-01-23 18:02:22', '2023-01-23 13:02:22', '', NULL, '0', NULL, NULL, '', 0, 0, 0),
(1970, 'ORDER_ID', '7', '2023-03-10 19:21:53', '2023-03-10 14:21:53', '', NULL, '0', NULL, NULL, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL,
  `newsletter_email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `newsletter_email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(88, '123@gmail.com', '2022-08-23 11:42:04', '2022-08-23 16:42:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
('070f4b4e-6125-45ea-bbbd-b51af8ff6448', 'App\\Notifications\\OffersNotification', 'App\\User', 1, '{\"icon\":\"fa-phone\",\"message\":\" sent you An Inquiry\",\"path\":\"http:\\/\\/localhost:8000\\/admin\\\\inquiry\"}', NULL, '2022-10-21 14:58:22', '2022-10-21 14:58:22', NULL),
('0d8a0240-6201-44ce-ba87-26b44f73b0a5', 'App\\Notifications\\NewsletterNotification', 'App\\User', 1, '{\"message\":\"123@gmail.com Subscribed You\",\"path\":\"http:\\/\\/localhost:8000\\/\\\\admin\\\\newsletters\"}', '2022-10-10 13:09:36', '2022-08-23 11:42:05', '2022-10-10 13:09:36', NULL),
('1b1ebe3a-ffb7-48cd-81af-df4c110e3b4c', 'App\\Notifications\\OffersNotification', 'App\\User', 1, '{\"icon\":\"fa-phone\",\"message\":\"admin@cloves.com sent you An Inquiry\",\"path\":\"http:\\/\\/localhost:8000\\/admin\\\\inquiry\"}', NULL, '2023-02-13 16:03:32', '2023-02-13 16:03:32', NULL),
('262e2ae9-55a8-4848-bebf-83fdae2d002e', 'App\\Notifications\\OffersNotification', 'App\\User', 1, '{\"icon\":\"fa-phone\",\"message\":\"jhon@gmail.com sent you An Inquiry\",\"path\":\"http:\\/\\/localhost:8000\\/admin\\\\inquiry\"}', '2022-08-23 12:02:00', '2022-08-19 12:34:16', '2022-08-23 12:02:00', NULL),
('41ea5d38-b5e2-4ad1-bf74-374e9a2d5626', 'App\\Notifications\\OffersNotification', 'App\\User', 1, '{\"icon\":\"fa-phone\",\"message\":\" sent you An Inquiry\",\"path\":\"http:\\/\\/localhost:8000\\/admin\\\\inquiry\"}', '2023-02-08 11:22:20', '2023-02-01 15:43:58', '2023-02-08 11:22:20', NULL),
('43d9d4d6-d321-4ab5-ac13-2c9792e654e3', 'App\\Notifications\\OffersNotification', 'App\\User', 1, '{\"icon\":\"fa-phone\",\"message\":\" sent you An Inquiry\",\"path\":\"http:\\/\\/localhost:8000\\/admin\\\\inquiry\"}', NULL, '2023-02-01 15:38:54', '2023-02-01 15:38:54', NULL),
('5e63a56f-b1d7-4a22-89a3-11a94038b7c5', 'App\\Notifications\\OffersNotification', 'App\\User', 1, '{\"icon\":\"fa-phone\",\"message\":\"fyny@mailinator.com sent you An Inquiry\",\"path\":\"http:\\/\\/localhost:8000\\/admin\\\\inquiry\"}', '2022-10-10 13:09:29', '2022-10-10 13:08:38', '2022-10-10 13:09:29', NULL),
('68837e28-e2ad-489b-8126-8fc25585ccec', 'App\\Notifications\\OffersNotification', 'App\\User', 1, '{\"icon\":\"fa-phone\",\"message\":\"mimugo@mailinator.com sent you An Inquiry\",\"path\":\"http:\\/\\/localhost:8000\\/admin\\\\inquiry\"}', NULL, '2022-10-14 12:27:36', '2022-10-14 12:27:36', NULL),
('6e19b3b9-cce2-4b76-99b9-2e4941a96168', 'App\\Notifications\\OffersNotification', 'App\\User', 1, '{\"icon\":\"fa-phone\",\"message\":\"burks@gmail.com sent you An Inquiry\",\"path\":\"http:\\/\\/localhost:8000\\/admin\\\\inquiry\"}', NULL, '2023-02-01 20:31:56', '2023-02-01 20:31:56', NULL),
('86da3c00-7449-43a2-a518-7d2c2a4e9a52', 'App\\Notifications\\OffersNotification', 'App\\User', 1, '{\"icon\":\"fa-phone\",\"message\":\" sent you An Inquiry\",\"path\":\"http:\\/\\/localhost:8000\\/admin\\\\inquiry\"}', NULL, '2022-10-21 14:58:57', '2022-10-21 14:58:57', NULL),
('89b6185e-c5d7-4e3f-b13d-cff277bfad91', 'App\\Notifications\\OffersNotification', 'App\\User', 1, '{\"icon\":\"fa-phone\",\"message\":\"mack@gmail.com sent you An Inquiry\",\"path\":\"http:\\/\\/localhost:8000\\/admin\\\\inquiry\"}', NULL, '2023-02-13 16:47:12', '2023-02-13 16:47:12', NULL),
('98eb6ac1-2d4d-4223-b58e-dd9e88ba50b8', 'App\\Notifications\\OffersNotification', 'App\\User', 1, '{\"icon\":\"fa-phone\",\"message\":\" sent you An Inquiry\",\"path\":\"http:\\/\\/localhost:8000\\/admin\\\\inquiry\"}', NULL, '2023-02-01 20:25:21', '2023-02-01 20:25:21', NULL),
('a8018d5c-3e46-44df-93e7-f7fafabf7e67', 'App\\Notifications\\OffersNotification', 'App\\User', 1, '{\"icon\":\"fa-phone\",\"message\":\" sent you An Inquiry\",\"path\":\"http:\\/\\/localhost:8000\\/admin\\\\inquiry\"}', NULL, '2022-10-21 13:29:53', '2022-10-21 13:29:53', NULL),
('c690724f-5e50-46f3-904c-a60e00d3a51d', 'App\\Notifications\\OffersNotification', 'App\\User', 1, '{\"icon\":\"fa-phone\",\"message\":\" sent you An Inquiry\",\"path\":\"http:\\/\\/localhost:8000\\/admin\\\\inquiry\"}', NULL, '2023-02-01 15:44:33', '2023-02-01 15:44:33', NULL),
('cafaf8c7-9d36-4072-9e76-02fba47881b7', 'App\\Notifications\\OffersNotification', 'App\\User', 1, '{\"icon\":\"fa-phone\",\"message\":\"admin@cloves.com sent you An Inquiry\",\"path\":\"http:\\/\\/localhost:8000\\/admin\\\\inquiry\"}', NULL, '2023-02-21 16:00:39', '2023-02-21 16:00:39', NULL),
('e5a457a2-a32b-49dd-9b47-31f2aaadb2f9', 'App\\Notifications\\OffersNotification', 'App\\User', 1, '{\"icon\":\"fa-phone\",\"message\":\"admin@cloves.com sent you An Inquiry\",\"path\":\"http:\\/\\/localhost:8000\\/admin\\\\inquiry\"}', NULL, '2023-02-13 16:16:32', '2023-02-13 16:16:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` text DEFAULT NULL,
  `product` varchar(255) DEFAULT NULL,
  `delivery_type` varchar(255) DEFAULT NULL,
  `priority` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `order_type` varchar(255) DEFAULT NULL,
  `user_location` text DEFAULT NULL,
  `delivery_location` text DEFAULT NULL,
  `pickup_location` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `current_date` varchar(255) DEFAULT NULL,
  `location` text DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `langitude` varchar(255) DEFAULT NULL,
  `time_from` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `time_to` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `boxes` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `order_status` tinyint(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `product`, `delivery_type`, `priority`, `user_id`, `full_name`, `first_name`, `email`, `country`, `city`, `organization`, `order_type`, `user_location`, `delivery_location`, `pickup_location`, `file_path`, `current_date`, `location`, `latitude`, `langitude`, `time_from`, `last_name`, `time_to`, `duration`, `boxes`, `notes`, `created_at`, `updated_at`, `deleted_at`, `status`, `order_status`) VALUES
(506, 'ORD4', 'Aut earum temporibus', 'D', 'M', 2038, 'Wade George', 'Jost', 'jost@mail.com', 'United States', 'California', 'Jimenez Norman Co', 'D', 'SD Mayer & Associates LLP, 235 Montgomery St 30th Floor, San Francisco, California 94104, United States', NULL, NULL, NULL, '2023-03-10', 'SDI Fireplaces, 370 Lang Rd, Burlingame, California 94010, United States', '37.791781', '-122.402681', '15:34', 'Philp', '15:34', '34', '33', 'Hic et sit aut qui v', '2023-03-09 20:15:07', '2023-03-11 00:22:19', NULL, 0, 1),
(508, 'ORD6', 'DM Product', 'D', 'M', 2038, 'Mouse', NULL, 'jost@mail.com', 'United States', 'California', 'DM Org', 'D', NULL, NULL, NULL, NULL, '2023-03-10', 'SD Mayer & Associates LLP, 235 Montgomery St 30th Floor, San Francisco, California 94104, United States', '37.791425', '-122.402735', '17:07', NULL, '17:07', '34', '4', 'no', '2023-03-09 21:06:40', '2023-03-11 00:22:16', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `password`, `token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(NULL, 'abc@gmail.com', NULL, '$2y$10$iQl8yl0SP0P9CEyhkzYkdOlFavJZaQcZeM2p/xVch1iff6BNnz6Ue', '2022-10-14 16:25:31', '2022-10-14 21:25:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `localisation` varchar(191) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(250) DEFAULT NULL,
  `pic` varchar(191) DEFAULT NULL,
  `country` varchar(191) DEFAULT NULL,
  `state` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `postal` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `bio`, `localisation`, `dob`, `gender`, `pic`, `country`, `state`, `city`, `address`, `postal`, `created_at`, `updated_at`) VALUES
(1, 1, 'One Call Does It All', 'male', '2017-09-13', 'male', '1665369810.png', 'USA', 'Bechtelar', 'New York', 'A-103, Street # 20, Downtown', '35768', '2019-12-09 23:00:46', '2022-10-09 21:43:30'),
(212, 2036, NULL, NULL, NULL, NULL, NULL, 'United States', 'California', 'California', '235 Montgomery St 30th Floor', '94104', '2023-02-14 13:39:06', '2023-02-14 13:39:06'),
(213, 2037, NULL, NULL, NULL, NULL, NULL, 'United States', 'California', 'California', '2301 Vine St', '94708', '2023-02-14 13:47:21', '2023-02-14 13:47:21'),
(214, 2038, NULL, NULL, NULL, NULL, '1676656282.png', 'United States', 'California', 'California', '235 Montgomery St 30th Floor', '94104', '2023-02-15 18:27:13', '2023-02-17 12:51:22'),
(215, 2039, NULL, NULL, NULL, NULL, NULL, 'United States', 'California', 'California', '235 Montgomery St 30th Floor', '94104', '2023-02-22 07:06:29', '2023-02-22 07:06:29'),
(216, 2040, NULL, NULL, NULL, NULL, NULL, 'United States', 'California', 'California', '235 Montgomery St 30th Floor', '94104', '2023-02-22 11:57:01', '2023-02-22 11:57:01'),
(217, 2041, NULL, NULL, NULL, NULL, NULL, 'United States', 'California', 'California', '235 Montgomery St 30th Floor', '94104', '2023-02-22 12:00:52', '2023-02-22 12:00:52'),
(218, 2043, NULL, NULL, NULL, NULL, NULL, 'United States', 'California', 'California', 'SD Mayer & Associates LLP, 235 Montgomery St 30th Floor, San Francisco, California 94104, United States', '94104', '2023-02-24 20:20:04', '2023-02-24 20:20:04'),
(219, 2044, NULL, NULL, NULL, NULL, NULL, 'United States', 'California', 'California', NULL, '94107', '2023-02-24 20:29:45', '2023-02-24 20:29:45'),
(220, 2045, NULL, NULL, NULL, NULL, NULL, 'United States', 'California', 'California', '235 Montgomery St 30th Floor', '94104', '2023-02-24 20:31:32', '2023-02-24 20:31:32'),
(221, 2046, NULL, NULL, NULL, NULL, NULL, 'United States', 'California', 'California', NULL, '94107', '2023-02-27 11:50:46', '2023-02-27 11:50:46'),
(222, 2047, NULL, NULL, NULL, NULL, NULL, 'United States', 'California', 'California', '235 Montgomery St 30th Floor', '94104', '2023-02-27 11:52:39', '2023-02-27 11:52:39'),
(223, 2048, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-27 12:07:27', '2023-02-27 12:07:27'),
(224, 2049, NULL, NULL, NULL, NULL, NULL, 'United States', 'California', 'California', NULL, '94708', '2023-02-27 12:34:17', '2023-02-27 12:34:17'),
(225, 2050, NULL, NULL, NULL, NULL, NULL, 'United States', 'California', 'California', '1960 Adeline St', '94607', '2023-02-27 15:58:43', '2023-02-27 15:58:43'),
(226, 2051, NULL, NULL, NULL, NULL, NULL, 'United States', 'California', 'California', NULL, '94107', '2023-02-27 16:00:09', '2023-02-27 16:00:09'),
(227, 2052, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-27 18:34:52', '2023-02-27 18:34:52'),
(228, 2053, NULL, NULL, NULL, NULL, NULL, 'United States', 'California', 'California', NULL, '94107', '2023-02-27 18:44:50', '2023-02-27 18:44:50'),
(229, 2054, NULL, NULL, NULL, NULL, NULL, 'United States', 'California', 'California', '370 Hayes St', '94102', '2023-02-27 18:45:23', '2023-02-27 18:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `label` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `label`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, '2019-11-06 16:57:52', '2019-11-06 16:57:52'),
(2, 'user', NULL, '2019-11-06 16:57:52', '2019-11-06 16:57:52'),
(3, 'vendor', NULL, '2019-11-06 16:57:52', '2019-11-06 16:57:52');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`) VALUES
(1, 1),
(2, 2020),
(2, 2021),
(2, 2023),
(2, 2024),
(2, 2025),
(2, 2026),
(2, 2027),
(2, 2028),
(2, 2030),
(2, 2031),
(2, 2032),
(2, 2035),
(2, 2036),
(2, 2037),
(2, 2038),
(2, 2046),
(2, 2047),
(2, 2050),
(2, 2051),
(3, 2022),
(3, 2029),
(3, 2033),
(3, 2034),
(3, 2039),
(3, 2040),
(3, 2041),
(3, 2042),
(3, 2043),
(3, 2044),
(3, 2045),
(3, 2048),
(3, 2049),
(3, 2052),
(3, 2053),
(3, 2054);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `long_description` text DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `slug`, `description`, `long_description`, `image_path`, `image1`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(65, 'Door To Door Delivery', 'door-to-door-delivery-1', '<p><span style=\"text-align: center;\">We ensure quick, accurate, and on-time delivery of medications to your customers on their doorstep.</span><br></p>', '<p><span style=\"color: rgb(0, 0, 0); font-family: amplreg; font-size: 23px;\">When it comes to door-to-door delivery of prescriptions, we are the service you should trust. We ensure quick, accurate, and on-time delivery of medications to your customers on their doorstep. With our door-to-door delivery service, we help your pharmacy enhance its service offerings and service the needs of your customers in a better way.</span><br></p>', 'uploads/admin/services_images/16654455641.png', 'uploads/admin/services_images/16654455641.jpg', '2022-10-13 20:53:28', '2022-10-13 15:53:28', NULL, 1),
(67, 'Same Day Delivery', 'same-day-delivery-1', '<p><span style=\"text-align: center;\">We have designed our same delivery services, keeping the needs of patients’ health and their convenience in mind.</span><br></p>', '<p><span style=\"color: rgb(0, 0, 0); font-family: amplreg; font-size: 23px;\">We have designed our same delivery services, keeping patients’ health and convenience in mind. Through our service, we ensure that we meet the urgent medication needs of patients around southern California. Our delivery service is also tractable, enabling customers to find the exact location of their medications and have an estimated delivery time.</span><br></p>', 'uploads/admin/services_images/16654457541.png', 'uploads/admin/services_images/16654457541.jpg', '2022-10-13 20:14:05', '2022-10-13 15:14:05', NULL, 1),
(68, 'Prescription Refill Assistance', 'prescription-refill-assistance', '<p>We can help make medications available to your customers every time they need them with our prescription refill assistance service.<br></p>', '<p><span style=\"color: rgb(0, 0, 0); font-family: amplreg; font-size: 23px;\">We can help make medications available to your customers every time they need them with our prescription refill assistance service. Our team is committed to enabling your pharmacy to deliver medications to your customers at their scheduled time. With our service by your side, all you need is to request our team for a regular delivery of medications to your customer, and we will do it for you.</span><br></p>', 'uploads/admin/services_images/16655931611.png', 'uploads/admin/services_images/16656216511.jpg', '2022-10-13 00:40:51', '2022-10-12 19:40:51', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `last_order` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `postal` varchar(255) DEFAULT NULL,
  `is_admin` varchar(255) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `reg_no` varchar(255) DEFAULT NULL,
  `org_url` varchar(255) DEFAULT NULL,
  `location` text DEFAULT NULL,
  `location_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_contact` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `order_id`, `last_order`, `first_name`, `fname`, `last_name`, `email`, `country`, `city`, `state`, `address`, `postal`, `is_admin`, `organization`, `reg_no`, `org_url`, `location`, `location_name`, `phone`, `company_name`, `company_contact`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, '', 'Admin', '', 'admin@cloves.com', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '$2y$10$EOzC6q4yGtAe0uZV9uOVWOP0G4BbJ7opMk5c2BLNN529jnatSmo4i', NULL, '2021-08-12 23:06:10', '2022-10-12 14:55:30', NULL),
(2028, 'ALRI1675732916', NULL, 'Alana', 'Alana Richardsss', 'Richards', 'fuzexof@mailinator.com', 'United States', 'California', NULL, NULL, NULL, NULL, 'AlanaOrg', NULL, NULL, 'SDES Alvarado, 30846 Watkins St, Union City, California 94587, United States', 'SDES Alvarado', '123-465-7507', NULL, NULL, NULL, '$2y$10$um8bJVmlyS0h/3u4lDJLceVuQXG2EYg5Kn2KQXiJqLLGTSOXWh1eS', NULL, '2023-02-06 20:21:56', '2023-02-28 12:58:24', '2023-02-28 17:58:24'),
(2037, 'TOPO1676400441', NULL, 'Tod', 'Poole', 'Poole', 'worktimelyy@gmail.com', 'Country', 'City', NULL, '2301 Vine St', '94708', NULL, 'PooleOrg', NULL, NULL, 'Dominican School of Philosophy and Theology, 2301 Vine St, Berkeley, California 94708, United States', 'Dominican School of Philosophy and Theology', '23904853249', NULL, NULL, NULL, '$2y$10$vgAS7OlfcgnpNznaQMJ9LODqYsIzI8uooNqq.rskmpmm23wcb0JYe', NULL, '2023-02-14 13:47:21', '2023-02-15 15:04:30', '2023-02-15 20:04:30'),
(2038, 'JOPH', 33, 'Jost', 'Jost Philpf', 'Philp', 'jost@mail.com', 'United States', 'California', 'California', '235 Montgomery St 30th Floor', '94104', NULL, 'Jost Philps', NULL, NULL, 'SD Mayer & Associates LLP, 235 Montgomery St 30th Floor, San Francisco, California 94104, United States', 'SD Mayer & Associates LLP', '174-584-9402', NULL, NULL, NULL, '$2y$10$312sPEX9hv5RDhPjwd.QhOLG4Rq/lyKrSB3VRUw2vaZ7IvKX.emqK', NULL, '2023-02-15 18:27:13', '2023-03-09 15:15:07', NULL),
(2039, 'BEDO', 3, 'Bert', 'Bert Doe', 'Doe', 'bret@mail.com', 'United States', 'California', NULL, '235 Montgomery St 30th Floor', '94104', NULL, 'BretOrg', NULL, NULL, 'SD Mayer & Associates LLP, 235 Montgomery St 30th Floor, San Francisco, California 94104, United States', 'SD Mayer & Associates LLP', '173-858-6234', NULL, NULL, NULL, '$2y$10$48o9Q2I5DHFhkanFQN/FkeN7QhOY2zI2W89feO9Z4Ino9cpUareQW', NULL, '2023-02-22 07:06:28', '2023-02-22 07:23:44', NULL),
(2040, 'DEJH', 1, 'Devin', 'Devin Jhon', 'Jhon', 'jhon@mail.com', 'United States', 'California', NULL, '235 Montgomery St 30th Floor', '94104', NULL, 'Morrison', NULL, NULL, 'SD Mayer & Associates LLP, 235 Montgomery St 30th Floor, San Francisco, California 94104, United States', 'SD Mayer & Associates LLP', '524-075-2083', NULL, NULL, NULL, '$2y$10$jJe1fQ542f/f1vMm7eWqQe8RJVra5DTXlPw3B3XKz2939SNXmqeJq', NULL, '2023-02-22 11:57:01', '2023-02-22 12:24:05', NULL),
(2041, 'JHMO', NULL, 'Jhon', 'Jhon Morris', 'Morris', 'jhonmorris@gmail.com', 'United States', 'California', NULL, '235 Montgomery St 30th Floor', '94104', NULL, 'Moriss Pharma', NULL, NULL, 'SD Mayer & Associates LLP, 235 Montgomery St 30th Floor, San Francisco, California 94104, United States', 'SD Mayer & Associates LLP', '578-512-8528', NULL, NULL, NULL, '$2y$10$81pykS3CRCeOSYb2rPpaY.iMW1EBDt3P6sUy9PXBel/SOgUlV.ODq', NULL, '2023-02-22 12:00:52', '2023-02-22 12:00:52', NULL),
(2045, 'GA', NULL, '', NULL, NULL, 'jyreligyxo@mailinator.com', 'United States', 'California', NULL, '235 Montgomery St 30th Floor', '94104', NULL, 'Garza Goodman Inc', NULL, NULL, 'SD Mayer & Associates LLP, 235 Montgomery St 30th Floor, San Francisco, California 94104, United States', 'SD Mayer & Associates LLP', '193-986-5279', NULL, NULL, NULL, '$2y$10$twZTl2EtgCaxr6mQAksaZuV/mi0MmTUFS.CPF2hMJL0EG4d2c4a5W', NULL, '2023-02-24 20:31:32', '2023-02-24 20:31:32', NULL),
(2046, 'BOGO', NULL, 'Boris', NULL, 'Gould', 'boris@mail.com', 'United States', 'California', NULL, NULL, '94107', NULL, NULL, NULL, NULL, 'DFJ South Park, San Francisco, California 94107, United States', 'DFJ South Park', '165-211-5493', NULL, NULL, NULL, '$2y$10$SPFfcQRIL6oVCWU2GjiYJOYHelF6suDRhq1/rrCsZ3n6HyGXvfHyO', NULL, '2023-02-27 11:50:46', '2023-02-27 11:50:46', NULL),
(2047, 'BLBA', 1, 'Blake', 'Blake Barnett', 'Barnett', 'blake@mail.com', 'United States', 'California', 'California', '235 Montgomery St 30th Floor', '94104', NULL, 'Blake Barnett', NULL, NULL, 'SD Mayer & Associates LLP, 235 Montgomery St 30th Floor, San Francisco, California 94104, United States', 'SD Mayer & Associates LLP', '190-245-9323', NULL, NULL, NULL, '$2y$10$3he8NMpdtehs.tsZwH3PeeFwrGAZwMWxeW/JuO33bvv7xYsgslsEa', NULL, '2023-02-27 11:52:39', '2023-02-27 12:00:47', NULL),
(2049, 'HO', 1, '', NULL, NULL, 'wetyfi@mailinator.com', 'United States', 'California', NULL, NULL, '94708', NULL, 'Howell Jarvis LLC', NULL, NULL, '2301 Vine Street, Berkeley, California 94708, United States', '2301 Vine Street', '198-199-4737', NULL, NULL, NULL, '$2y$10$bmqnuJVQ869h9ruWAFnvW.vKis3n9/y.9u1HqRMTG9j15MbQx3SwS', NULL, '2023-02-27 12:34:17', '2023-02-27 12:34:41', NULL),
(2050, 'RONE', NULL, 'Rose', 'NelsonRose', 'Nelson', 'vanydocyt@mailinator.com', 'United States', 'California', NULL, '1960 Adeline St', '94607', NULL, NULL, NULL, NULL, 'Ghost Town Brewing, 1960 Adeline St, Oakland, California 94607, United States', 'Ghost Town Brewing', '155-396-7791', NULL, NULL, NULL, '$2y$10$2KYMukCABHeBsBV3RDy9SeCkM5d4992lwmXVXq1SDrTBckqj2qRMG', NULL, '2023-02-27 15:58:43', '2023-02-27 15:58:43', NULL),
(2051, 'JOBA', NULL, 'jost', 'Banks jost', 'Banks', 'philp@gmail.com', 'United States', 'California', 'California', NULL, '94107', NULL, NULL, NULL, NULL, 'DFJ South Park, San Francisco, California 94107, United States', 'DFJ South Park', '162-350-7133', NULL, NULL, NULL, '$2y$10$LdgTVhXWg/mxPi.RQlgsY.q7nE3DzvJyZDNpLmfrGTYk4p/CBRE4e', NULL, '2023-02-27 16:00:09', '2023-02-27 16:01:57', NULL),
(2053, 'PE', NULL, NULL, NULL, NULL, 'byfyqymuq@mailinator.com', 'United States', 'California', NULL, NULL, '94107', NULL, 'Pena and Carlson Trading', 'Voluptatem non labor', 'Ea ea architecto qui', 'DFJ South Park, San Francisco, California 94107, United States', 'DFJ South Park', '183-370-4551', NULL, NULL, NULL, '$2y$10$1Vt6gFzrb2rHBw81rIth6eNkXZTU//PFGHcm6.7Lui5kkm6QqtGuG', NULL, '2023-02-27 18:44:50', '2023-02-27 18:44:50', NULL),
(2054, 'GU', 1, NULL, NULL, NULL, 'pharma@mail.com', 'United States', 'California', 'California', '370 Hayes St', '94102', NULL, 'mypharmacy', 'Ab sunt impedit qui', 'Quos iusto dignissim', 'F.Dorian, 370 Hayes St, San Francisco, California 94102, United States', 'F.Dorian', '169-862-5853', NULL, NULL, NULL, '$2y$10$D8kIpi6knE6n/1ZA4mN3UeXzS/jHrI678YrR5yjPiAyFfnwZaKxki', NULL, '2023-02-27 18:45:23', '2023-02-27 19:15:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `why_choose_us`
--

CREATE TABLE `why_choose_us` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `why_choose_us`
--

INSERT INTO `why_choose_us` (`id`, `title`, `description`, `image_path`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(20, 'speed', '<p style=\"margin-bottom: 25px; font-family: amplreg; line-height: 40px; font-size: 27px; color: rgb(57, 57, 57);\">We understand the importance of getting meds to homes safely, securely and on time</p><p style=\"margin-bottom: 25px; font-family: amplreg; line-height: 40px; font-size: 27px; color: rgb(57, 57, 57);\">Extending our hand to help older Americans who are less mobile</p><p style=\"margin-bottom: 25px; font-family: amplreg; line-height: 40px; font-size: 27px; color: rgb(57, 57, 57);\">Offering customer convenience and reliable service</p>', 'uploads/admin/why_choose_us/1665430585.png', '2022-10-10 19:46:50', '2022-10-10 19:46:50', NULL, 1),
(23, 'accuracy', '<p style=\"margin-bottom: 25px; font-family: amplreg; line-height: 40px; font-size: 27px; color: rgb(57, 57, 57);\">We believe in getting it right.</p><p style=\"margin-bottom: 25px; font-family: amplreg; line-height: 40px; font-size: 27px; color: rgb(57, 57, 57);\">Offering hope to people battling addiction and a chance for recovery</p><p style=\"margin-bottom: 25px; font-family: amplreg; line-height: 40px; font-size: 27px; color: rgb(57, 57, 57);\">Treatments that enhance the quality of life in many respects</p>', 'uploads/admin/why_choose_us/16655949871.png', '2022-10-12 17:16:27', '2022-10-12 17:16:27', NULL, 1),
(24, 'care', '<p style=\"margin-bottom: 25px; font-family: amplreg; line-height: 40px; font-size: 27px; color: rgb(57, 57, 57);\">We believe in strong customer support and the role we take to make a true impact because every detail matters</p><p style=\"margin-bottom: 25px; font-family: amplreg; line-height: 40px; font-size: 27px; color: rgb(57, 57, 57);\">Supporting individuals towards better health and wellness</p>', 'uploads/admin/why_choose_us/1665604600.png', '2022-10-12 14:56:40', '2022-10-12 19:56:40', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_request`
--
ALTER TABLE `delivery_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_banner`
--
ALTER TABLE `main_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_flag`
--
ALTER TABLE `m_flag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`role_id`,`user_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `why_choose_us`
--
ALTER TABLE `why_choose_us`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1445;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=454;

--
-- AUTO_INCREMENT for table `delivery_request`
--
ALTER TABLE `delivery_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `main_banner`
--
ALTER TABLE `main_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=526;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2055;

--
-- AUTO_INCREMENT for table `why_choose_us`
--
ALTER TABLE `why_choose_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
