-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2024 at 08:57 PM
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
-- Database: `floraquiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `easy`
--

CREATE TABLE `easy` (
  `easyID` int(11) NOT NULL,
  `Ecategory` varchar(255) NOT NULL,
  `EtypeQuestion` varchar(255) NOT NULL,
  `Epoint` int(11) NOT NULL,
  `Equestion` varchar(255) NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL,
  `Ecorrectanswer` varchar(255) NOT NULL,
  `Eimgupload` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `easy`
--

INSERT INTO `easy` (`easyID`, `Ecategory`, `EtypeQuestion`, `Epoint`, `Equestion`, `option1`, `option2`, `option3`, `option4`, `Ecorrectanswer`, `Eimgupload`) VALUES
(19, 'plantTrivia', 'multipleChoice', 2, 'What is the process by which plants make their own food using sunlight?', 'Photosynthesis', 'Respiration', 'Transpiration', 'Germination', 'option1', ''),
(20, 'plantTrivia', 'multipleChoice', 2, 'Which part of the plant absorbs water and nutrients from the soil?', 'Leaves', 'Stem', 'Roots', 'Flowers', 'option3', ''),
(21, 'plantTrivia', 'multipleChoice', 3, 'What do you call a young plant that has just emerged from a seed?\\r\\n', 'Sprouts', 'Bud', 'Leaf', 'Branch', 'option1', ''),
(22, 'plantTrivia', 'multipleChoice', 2, 'Which of these is not a basic need for plants to grow?\\r\\n', 'Water', 'Sunlight', 'Soil', 'Music', 'option4', ''),
(23, 'plantTrivia', 'multipleChoice', 3, 'Which part of the plant produces seeds?', 'Roots', 'Stem', 'Leaves', 'Flower', 'option4', ''),
(24, 'plantIdentification', 'trueOrFalse', 2, 'Roses always have thorns.', 'TRUE', 'FALSE', '', '', 'option2', ''),
(25, 'plantCare', 'trueOrFalse', 2, 'All plants need direct sunlight to grow.', 'TRUE', 'FALSE', '', '', 'option2', ''),
(26, 'plantUse', 'trueOrFalse', 2, 'Aloe vera can be used to treat minor burns.', 'TRUE', 'FALSE', '', '', 'option1', ''),
(27, 'plantTrivia', 'trueOrFalse', 3, 'The largest flower in the world is the Rafflesia.', 'TRUE', 'FALSE', '', '', 'option1', ''),
(28, 'environmentalImpact', 'trueOrFalse', 3, 'Trees help reduce air pollution.\\r\\n', 'TRUE', 'FALSE', '', '', 'option1', ''),
(29, 'plantIdentification', 'trueOrFalse', 3, 'Cacti only grow in deserts.', 'TRUE', 'FALSE', '', '', 'option2', ''),
(30, 'plantCare', 'trueOrFalse', 3, 'Watering plants in the middle of a hot day is best for them.\\r\\n', 'TRUE', 'FALSE', '', '', 'option2', ''),
(31, 'plantIdentification', 'imageIdentification', 3, 'Which flower is shown in the image?', 'Tulip', 'Rose', 'Daisy', 'Lily', 'option2', 'uploads/easy/rose.png'),
(32, 'plantCare', 'imageIdentification', 3, 'What is the best time of day to water most plants?', 'Midday', 'Late Afternoon', 'Early Morning', 'Midnight', 'option3', 'uploads/easy/lovepik-watering-plants-png-image_401684848_wh1200.png'),
(33, 'plantUse', 'imageIdentification', 3, 'What is aloe vera commonly used for?', 'Flavoring food', 'Dyeing fabric', 'Treating Minor burn', 'Building furniture', 'option3', 'uploads/easy/Aloe-vera-fresh-leaf-Premium-image-PNG.png'),
(34, 'plantIdentification', 'matchingType', 2, 'Rose:flower - Oak:_____\\r\\n\\r\\n', 'fruit', 'tree', 'vegetable', 'grass', 'option2', ''),
(35, 'plantCare', 'matchingType', 3, 'Watering can:watering - Pruning shears:_____\\r\\n', 'digging', 'planting', 'cutting', 'fertilizing', 'option3', ''),
(36, 'plantIdentification', 'matchingType', 2, 'Sunflower:seed - Potato:_____\\r\\n', 'fruit', 'flower', 'leaf', 'tuber', 'option4', ''),
(37, 'plantTrivia', 'fillInTheBlanks', 3, 'The process by which plants make their own food using sunlight is called', '', '', '', '', 'PHOTOSYNTHESIS', ''),
(38, 'plantTrivia', 'fillInTheBlanks', 3, 'The ____________ is the part of a flower that produces pollen.\\r\\n', '', '', '', '', 'STAMEN', ''),
(39, 'environmentalImpact', 'fillInTheBlanks', 3, 'Cacti are well-adapted to survive in ____________ environments.', '', '', '', '', 'DESERT', '');

-- --------------------------------------------------------

--
-- Table structure for table `fill-in-the-blank`
--

CREATE TABLE `fill-in-the-blank` (
  `fbID` int(11) NOT NULL,
  `fbcat` varchar(255) NOT NULL,
  `fbpoints` int(11) NOT NULL,
  `fbquest` varchar(255) NOT NULL,
  `fbansw` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fill-in-the-blank`
--

INSERT INTO `fill-in-the-blank` (`fbID`, `fbcat`, `fbpoints`, `fbquest`, `fbansw`) VALUES
(8, 'plant-trivia', 2, 'sad', 'VSVD'),
(9, 'environmental-impact', 1, 'csav', 'ALALA'),
(13, 'plant-identification', 3, 'asc', 'bfb'),
(14, 'plant-care', 3, 'asc', 'ascb');

-- --------------------------------------------------------

--
-- Table structure for table `hard`
--

CREATE TABLE `hard` (
  `hardID` int(11) NOT NULL,
  `Hcategory` varchar(255) NOT NULL,
  `Hcorrectanswer` varchar(255) NOT NULL,
  `Himgupload` varchar(255) NOT NULL,
  `Hpoint` int(11) NOT NULL,
  `Hquestion` varchar(255) NOT NULL,
  `HtypeQuestion` varchar(255) NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hard`
--

INSERT INTO `hard` (`hardID`, `Hcategory`, `Hcorrectanswer`, `Himgupload`, `Hpoint`, `Hquestion`, `HtypeQuestion`, `option1`, `option2`, `option3`, `option4`) VALUES
(5, 'plantTrivia', 'option4', '', 4, 'Which of these plant pigments is not involved in photosynthesis?', 'multipleChoice', 'Chlorophyll', 'Chlorophyll b', 'Carotenoids', 'Anthocyanins'),
(6, 'plantTrivia', 'option4', '', 5, 'Which of these is not a type of trichome?\\r\\n', 'multipleChoice', 'Glandular', 'Non-glandular', 'Stellate', 'Vascular'),
(7, 'plantTrivia', 'option2', '', 5, 'What is the name of the process by which plants lose leaves in response to drought or cold temperatures?', 'multipleChoice', 'Senescene', 'Abscission', 'Dormancy', 'Vernalization'),
(8, 'plantTrivia', 'option4', '', 4, 'Which of these is not a type of plant vascular tissue?\\r\\n', 'multipleChoice', 'Xylem', 'Phloem', 'Cambium', 'Collenchyma'),
(9, 'plantTrivia', 'option1', '', 5, 'What is the term for plants that flower only once in their lifetime and then die?', 'multipleChoice', 'Monocarpic', 'Polycarpic', 'Perennial', 'Biennial'),
(10, 'plantIdentification', 'option2', '', 4, 'The presence of parallel leaf venation always indicates a monocot plant.', 'trueOrFalse', 'TRUE', 'FALSE', '', ''),
(11, 'plantCare', 'option2', '', 3, 'Mycorrhizal fungi associations are beneficial for all plant species.\\r\\n', 'trueOrFalse', 'TRUE', 'FALSE', '', ''),
(12, 'plantUse', 'option1', '', 3, 'Taxol, a chemotherapy drug, was originally derived from the Pacific yew tree.', 'trueOrFalse', 'TRUE', 'FALSE', '', ''),
(13, 'plantTrivia', 'option2', '', 3, ' The corpse flower (Amorphophallus titanum) blooms annually.', 'trueOrFalse', 'TRUE', 'FALSE', '', ''),
(14, 'plantIdentification', 'option2', '', 3, 'All plants in the family Fabaceae (legumes) have the ability to fix nitrogen.', 'trueOrFalse', 'TRUE', 'FALSE', '', ''),
(15, 'plantUse', 'option1', '', 3, 'The rotenone insecticide is derived from the roots of certain legume species.', 'trueOrFalse', 'TRUE', 'FALSE', '', ''),
(16, 'environmentalImpact', 'option2', '', 3, 'C4 plants are always more efficient at carbon fixation than C3 plants in all environments.\\r\\n', 'trueOrFalse', 'TRUE', 'FALSE', '', ''),
(17, 'plantTrivia', 'option3', '', 3, 'Apple seed:apple tree - Spore:_____\\r\\n', 'matchingType', 'mammal', 'insect', 'fern', 'fish'),
(18, 'plantIdentification', 'option4', '', 3, 'Chlorophyll:green - Carotene:_____\\r\\n', 'matchingType', 'blue', 'red', 'purple', 'orange'),
(19, 'plantCare', 'option2', '', 3, 'Vertical farming:space efficiency - Crop rotation:_____', 'matchingType', 'pest control', 'soil health', 'faster growth', 'increase yield'),
(20, 'environmentalImpact', 'GREENHOUSE', '', 5, 'The ____________ effect refers to the warming of Earth\\\'s surface due to certain gases in the atmosphere trapping heat.', 'fillInTheBlanks', '', '', '', ''),
(21, 'plantUse', 'GIBBERELLIN', '', 5, ' ____________ is a natural plant hormone that promotes cell elongation and is commonly used in agriculture to increase fruit size.', 'fillInTheBlanks', '', '', '', ''),
(22, 'plantCare', 'PHYTOREMEDIATION', '', 5, 'The process of ____________ involves the use of plants to remove contaminants from soil, water, or air.', 'fillInTheBlanks', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `image-identity`
--

CREATE TABLE `image-identity` (
  `imgID` int(11) NOT NULL,
  `imgcat` varchar(255) NOT NULL,
  `imgpoints` int(11) NOT NULL,
  `imgquest` varchar(255) NOT NULL,
  `imgupload` varchar(255) NOT NULL,
  `imgansw` varchar(255) NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image-identity`
--

INSERT INTO `image-identity` (`imgID`, `imgcat`, `imgpoints`, `imgquest`, `imgupload`, `imgansw`, `option1`, `option2`, `option3`, `option4`) VALUES
(1, 'plant-identification', 4, 'zdf', 'uploads/logo-removebg-preview.png', '2', 'vds', 'ds', 'sc', 'dsv'),
(2, 'plant-uses', 3, 'asdABAD', 'uploads/webcam-toy-photo2.jpg', '1', 'SisterAbad', 'hehf h', 'vas sd', 'vinland saga'),
(3, 'plant-uses', 3, 'Kinsa ni?', 'uploads/240130-222117.jpg', '4', 'Jebon', 'Anthony', 'Quijoy', 'Abad'),
(4, 'plant-trivia', 3, 'ascavvd', 'uploads/Screenshot 2024-02-02 231342.png', '1', 'asv', 'sacc', 'acs', 'asca'),
(5, 'plant-care', 3, 'asc', 'uploads/nene.jpg', '1', 'asc', 'asc', 'casv', 'vd'),
(6, 'plant-trivia', 2, 'ac', 'uploads/Screenshot 2024-02-07 000631.png', '4', 'sac', 'scc', 'vsd', 'sd3'),
(7, 'plant-trivia', 3, 'test', 'uploads/Screenshot 2024-02-06 234730.png', '2', 'sdf', 'sac', 'cs', 'sca'),
(8, 'plant-trivia', 3, 'zcs', 'uploads/Screenshot 2024-02-07 000631.png', '1', 'asc', 'sa', 'csac', 'cs');

-- --------------------------------------------------------

--
-- Table structure for table `matching-type`
--

CREATE TABLE `matching-type` (
  `mtID` int(11) NOT NULL,
  `mtcat` varchar(255) NOT NULL,
  `mtpoints` int(11) NOT NULL,
  `mtquest` varchar(255) NOT NULL,
  `mtansw` varchar(255) NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matching-type`
--

INSERT INTO `matching-type` (`mtID`, `mtcat`, `mtpoints`, `mtquest`, `mtansw`, `option1`, `option2`, `option3`, `option4`) VALUES
(1, 'plant-care', 2, 'fasv', '2', 'sfvs', 'sc', 'dvf', 'vd'),
(2, 'plant-care', 2, 'sac', '1', 'Abad', 'aAv', 'anvdn', 'BCas'),
(3, 'plant-trivia', 1, 'djfjdfj', '2', 'asf', 'sacv', 'vds', 'csvd'),
(4, 'plant-care', 5, 'asc', '2', 'sa', 'csa', 'csa', 'cs'),
(5, 'plant-uses', 4, 'asf', '2', 'asc', 'xc', 'avcCSA', 'asc'),
(6, 'plant-uses', 4, 'sd', '3', 'vd', 'acs', 'ca', 'csa');

-- --------------------------------------------------------

--
-- Table structure for table `medium`
--

CREATE TABLE `medium` (
  `mediumID` int(11) NOT NULL,
  `Mcategory` varchar(255) NOT NULL,
  `Mcorrectanswer` varchar(255) NOT NULL,
  `Mimgupload` varchar(255) NOT NULL,
  `Mpoint` int(11) NOT NULL,
  `Mquestion` varchar(255) NOT NULL,
  `MtypeQuestion` varchar(255) NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medium`
--

INSERT INTO `medium` (`mediumID`, `Mcategory`, `Mcorrectanswer`, `Mimgupload`, `Mpoint`, `Mquestion`, `MtypeQuestion`, `option1`, `option2`, `option3`, `option4`) VALUES
(5, 'plantTrivia', 'option3', '', 3, 'Which of these plant hormones is responsible for fruit ripening?', 'multipleChoice', 'Auxin', 'Cytokinin', 'Ethylene', 'Gibberellin'),
(6, 'plantTrivia', 'option2', '', 3, 'What is the process of water movement through a plant called?', 'multipleChoice', 'Photosynthesis', 'Transpiration', 'Respiration', 'Osmosis'),
(7, 'plantTrivia', 'option4', '', 3, 'Which of these is not a type of plant tissue?', 'multipleChoice', 'Xylem', 'Phloem', 'Cambium', 'Cerebrum'),
(8, 'plantTrivia', 'option3', '', 3, 'Which of these is not a method of asexual reproduction in plants?', 'multipleChoice', 'Runners', 'Bulbs', 'Pollination', 'Cuttings'),
(9, 'plantTrivia', 'option2', '', 4, 'What is the name of the tissue in plants that transports water and minerals?', 'multipleChoice', 'Phloem', 'Xylem', 'Epidermis', 'Mesophyll'),
(10, 'environmentalImpact', 'option2', '', 3, 'Invasive plant species always have a negative impact on local ecosystems.\\r\\n', 'trueOrFalse', 'TRUE', 'FALSE', '', ''),
(11, 'plantCare', 'option2', '', 3, 'Adding coffee grounds to soil always benefits plants.', 'trueOrFalse', 'TRUE', 'FALSE', '', ''),
(12, 'plantUse', 'option1', '', 3, 'Neem oil is used as a natural pesticide.\\r\\n', 'trueOrFalse', 'TRUE', 'FALSE', '', ''),
(13, 'plantTrivia', 'option1', '', 3, 'The world\\\'s oldest known living tree is over 5,000 years old.\\r\\n', 'trueOrFalse', 'TRUE', 'FALSE', '', ''),
(14, 'environmentalImpact', 'option1', '', 3, 'Wetland plants play a crucial role in water purification.', 'trueOrFalse', 'TRUE', 'FALSE', '', ''),
(15, 'plantUse', 'option1', 'uploads/medium/t545lpoa4lqb1.png', 3, 'Which pain relief medication was originally derived from willow bark?\\r\\n', 'imageIdentification', 'Ibuprofen', 'Acetaminophen', 'Aspirin', 'Naproxen'),
(16, 'environmentalImpact', 'option2', 'uploads/medium/cattails_and_bulrushes.jpg', 3, 'What important function do wetland plants serve?', 'imageIdentification', 'Wind protection', 'Water purification', 'Air conditioning', 'Soil compaction'),
(17, 'plantCare', 'option4', 'uploads/medium/71TyqXNAoAS._AC_UF350,350_QL80_.jpg', 3, 'When is the best time to prune most flowering shrubs?', 'imageIdentification', 'While flowering', 'Mid-summer', 'Late fall', 'Just after flowering'),
(18, 'plantIdentification', 'option2', 'uploads/medium/images (1).jpg', 3, 'Which plant cell structure is responsible for photosynthesis?\\r\\n', 'imageIdentification', 'Nucleus', 'Chloroplast', 'Mitochondria', 'Vacuole'),
(19, 'plantCare', 'option3', 'uploads/medium/Soil-Tester-channel-323-article-227229.jpg', 3, 'What soil pH range is ideal for most plants?', 'imageIdentification', '3.0-4.0', '4.5-5.5', '6.0-7.0', '8.0-9.0'),
(20, 'plantTrivia', 'option2', 'uploads/medium/59-597990_ginkgo-bank-leaves-bank-the-leaves-yellow-ginkgo.png', 3, 'The Ginkgo biloba is often called a \\\"living fossil\\\" because:', 'imageIdentification', 'It\\\'s the oldest individual tree', 'It\\\'s unchanged for millions of years', 'It turns to stone as it ages', 'It only grows in ancient forests'),
(21, 'plantTrivia', 'option3', '', 2, 'Tree rings:age - Leaf color:_____', 'matchingType', 'height', 'weight', 'season', 'species'),
(22, 'environmentalImpact', 'option3', '', 3, 'Rainforest:biodiversity - Desert:_____', 'matchingType', 'humidity', 'cold', 'aridity', 'darkness'),
(23, 'environmentalImpact', 'option2', '', 3, 'Composting:soil improvement - Planting trees:_____\\r\\n', 'matchingType', 'water pollution', 'air purification', 'noise reduction', 'light pollution'),
(24, 'plantTrivia', 'EUCALYPTUS', '', 4, 'The ____________ tree, native to Australia, is the primary food source for koalas.', 'fillInTheBlanks', '', '', '', ''),
(25, 'plantCare', 'HYDROPONIC', '', 3, '____________ farming is a method of growing crops or raising fish using mineral nutrient solutions in water without soil.', 'fillInTheBlanks', '', '', '', ''),
(26, 'plantTrivia', 'BIODIVERSITY', '', 3, 'The rapid loss of plant species and their habitats is known as ____________ loss.', 'fillInTheBlanks', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `multiple-choice`
--

CREATE TABLE `multiple-choice` (
  `mult-id` int(11) NOT NULL,
  `multcategory` varchar(255) NOT NULL,
  `multpoints` int(11) NOT NULL,
  `multques` varchar(255) NOT NULL,
  `multansw` varchar(255) NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `multiple-choice`
--

INSERT INTO `multiple-choice` (`mult-id`, `multcategory`, `multpoints`, `multques`, `multansw`, `option1`, `option2`, `option3`, `option4`) VALUES
(1, 'plant-care', 5, 'asdasd', '3', 'dad', 'sacs', 'fwef3', 'fbfb'),
(2, 'plant-care', 5, 'asdasd', '3', 'dad', 'sacs', 'fwef3', 'fbfb'),
(3, 'plant-identification', 3, 'sac', '2', 'asc', 'asc', 'sc', 'sv'),
(4, 'plant-care', 4, 'asd', '1', 'vdsv', 'vdvqs', 'cs', 'csa'),
(5, 'plant-care', 3, 'VDSvs', '1', 'safa', 'asaf', 'sa', 'vds'),
(6, 'plant-care', 2, 'sdva', '2', 'sdv', 'vds', 'vds', 'cs'),
(7, 'plant-care', 3, 'asc', '1', 'asc', 'csvs', 'nnk', 'nknk'),
(8, 'plant-identification', 2, 'asc', '2', 'csawf', 'csgfd', 'cdsv', 'sc');

-- --------------------------------------------------------

--
-- Table structure for table `truefalse`
--

CREATE TABLE `truefalse` (
  `tfID` int(11) NOT NULL,
  `tfcategory` varchar(255) NOT NULL,
  `tfpoints` int(11) NOT NULL,
  `tfquest` varchar(255) NOT NULL,
  `tfansw` varchar(255) NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `truefalse`
--

INSERT INTO `truefalse` (`tfID`, `tfcategory`, `tfpoints`, `tfquest`, `tfansw`, `option1`, `option2`) VALUES
(1, 'plant-care', 5, 'Gwapo KO?', 'true', 'TRUE', 'FALSE'),
(2, 'plant-trivia', 2, 'vdsdv', 'True', 'True', 'False'),
(3, 'plant-trivia', 1, 'HAHAHAHAHA', 'False', 'True', 'False'),
(4, 'plant-care', 5, 'Kadl', 'False', 'True', 'False'),
(5, 'plant-care', 2, 'cas', 'True', 'True', 'False'),
(6, 'plant-care', 2, 'asc', 'False', 'True', 'False'),
(7, 'plant-uses', 3, 'avs', 'False', 'True', 'False');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `hearts` int(11) NOT NULL,
  `lifelines` int(11) NOT NULL DEFAULT 3,
  `skips` int(11) NOT NULL,
  `achievements` text NOT NULL,
  `last_heart_regeneration` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `image`, `nickname`, `hearts`, `lifelines`, `skips`, `achievements`, `last_heart_regeneration`, `points`) VALUES
(3, 'vfvdfb', '$2y$10$lAm.ux1trclnx4fnlCxu5Okqg6b1kSCczGLw1nFGAYNvxAELS.LnK', 'upload/240130-222117.jpg', '', 0, 0, 0, '', 0, 0),
(4, 'mingming', '$2y$10$w4AZcP5./MQ59DIePI7DbunD7h25o2LHc0jqp3jWAR.uBcrqOey3O', 'upload/nene.jpg', '', 0, 0, 0, '', 0, 0),
(5, 'pjbonbon', '$2y$10$gMZe5T.csgf1vpS6nRzknun6jJg28HiJeG89Z7Jp6bKwov6oPxKEe', 'upload/nene.jpg', 'Load', 3, 0, 0, '', 1724832000, 57),
(6, 'hellow', '$2y$10$Ndbx24ocTJ3L0A122thKMOFQLDlznxWgJf7AQscznprSsYiDHGici', 'upload/1F_lodger2.jpg', 'Pjjjj', 2, 0, 0, '', 1724869200, 85),
(7, 'test', '$2y$10$e8pyTC6sY8sLwT.lUMXswO.5UtMBRrd51kgwimUH1Uz1OzdEzqSV2', 'upload/images (11).jpeg', 'Test', 3, 0, 0, '', 1724741400, 0),
(8, 'kalid', '$2y$10$pq8rmeM1gy7/kBbZuEOZ9ePeH.NkCj.2zMhSFQir5K8HpQiAsbIqK', 'upload/240130-222117.jpg', 'ABad Pogi', 2, 0, 0, '', 1724835000, 23);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `easy`
--
ALTER TABLE `easy`
  ADD PRIMARY KEY (`easyID`);

--
-- Indexes for table `fill-in-the-blank`
--
ALTER TABLE `fill-in-the-blank`
  ADD PRIMARY KEY (`fbID`);

--
-- Indexes for table `hard`
--
ALTER TABLE `hard`
  ADD PRIMARY KEY (`hardID`);

--
-- Indexes for table `image-identity`
--
ALTER TABLE `image-identity`
  ADD PRIMARY KEY (`imgID`);

--
-- Indexes for table `matching-type`
--
ALTER TABLE `matching-type`
  ADD PRIMARY KEY (`mtID`);

--
-- Indexes for table `medium`
--
ALTER TABLE `medium`
  ADD PRIMARY KEY (`mediumID`);

--
-- Indexes for table `multiple-choice`
--
ALTER TABLE `multiple-choice`
  ADD PRIMARY KEY (`mult-id`);

--
-- Indexes for table `truefalse`
--
ALTER TABLE `truefalse`
  ADD PRIMARY KEY (`tfID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `easy`
--
ALTER TABLE `easy`
  MODIFY `easyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `fill-in-the-blank`
--
ALTER TABLE `fill-in-the-blank`
  MODIFY `fbID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hard`
--
ALTER TABLE `hard`
  MODIFY `hardID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `image-identity`
--
ALTER TABLE `image-identity`
  MODIFY `imgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `matching-type`
--
ALTER TABLE `matching-type`
  MODIFY `mtID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `medium`
--
ALTER TABLE `medium`
  MODIFY `mediumID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `multiple-choice`
--
ALTER TABLE `multiple-choice`
  MODIFY `mult-id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `truefalse`
--
ALTER TABLE `truefalse`
  MODIFY `tfID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
