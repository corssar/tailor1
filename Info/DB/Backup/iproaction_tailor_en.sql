/*
Navicat MySQL Data Transfer

Source Server         : TAYLOR_DEV
Source Server Version : 50157
Source Host           : 194.28.172.183:3306
Source Database       : iproaction_tailor

Target Server Type    : MYSQL
Target Server Version : 50157
File Encoding         : 65001

Date: 2014-08-13 16:26:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `be_Admin`
-- ----------------------------
DROP TABLE IF EXISTS `be_Admin`;
CREATE TABLE `be_Admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `viewId` int(11) unsigned DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` char(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rights` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `isAccess` int(10) NOT NULL,
  `lastLogin` int(10) unsigned NOT NULL,
  `roleId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_view_admin` (`viewId`),
  CONSTRAINT `fk_view_admin` FOREIGN KEY (`viewId`) REFERENCES `be_View` (`viewId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of be_Admin
-- ----------------------------
INSERT INTO `be_Admin` VALUES ('1', '32', 'iproman', '6e3e8fd9b863a92ff9ddca0b1a0aa3fe9e221d62', 'team@iproaction.com', '', 'ipro', '1', '1407936167', '9');

-- ----------------------------
-- Table structure for `be_AdminLanguage`
-- ----------------------------
DROP TABLE IF EXISTS `be_AdminLanguage`;
CREATE TABLE `be_AdminLanguage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `langId` int(10) unsigned NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `langId` (`langId`)
) ENGINE=InnoDB AUTO_INCREMENT=1015 DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of be_AdminLanguage
-- ----------------------------
INSERT INTO `be_AdminLanguage` VALUES ('1', '1', 'MM_CONTENT_MANAGER', 'Контент');
INSERT INTO `be_AdminLanguage` VALUES ('2', '1', 'MM_PRODUCT_MANAGER', 'Продукти');
INSERT INTO `be_AdminLanguage` VALUES ('14', '2', 'MM_CONTENT_MANAGER', 'Контент');
INSERT INTO `be_AdminLanguage` VALUES ('15', '2', 'MM_PRODUCT_MANAGER', 'Продукты');
INSERT INTO `be_AdminLanguage` VALUES ('16', '3', 'MM_CONTENT_MANAGER', 'Контент');
INSERT INTO `be_AdminLanguage` VALUES ('17', '3', 'MM_PRODUCT_MANAGER', 'Products');
INSERT INTO `be_AdminLanguage` VALUES ('18', '1', 'MM_USER_MANAGER', 'Користувачі');
INSERT INTO `be_AdminLanguage` VALUES ('20', '3', 'MM_ADMIN_MANAGER', 'Admins');
INSERT INTO `be_AdminLanguage` VALUES ('21', '2', 'MM_PREFERENCES', 'Настройки');
INSERT INTO `be_AdminLanguage` VALUES ('22', '3', 'LOGOUT', 'Logout');
INSERT INTO `be_AdminLanguage` VALUES ('23', '1', 'MM_PREFERENCES', 'Налаштування');
INSERT INTO `be_AdminLanguage` VALUES ('24', '1', 'MM_ADMIN_MANAGER', 'Адміністратори');
INSERT INTO `be_AdminLanguage` VALUES ('25', '1', 'LOGOUT', 'Вихід');
INSERT INTO `be_AdminLanguage` VALUES ('26', '2', 'MM_USER_MANAGER', 'Пользователи');
INSERT INTO `be_AdminLanguage` VALUES ('27', '2', 'MM_ADMIN_MANAGER', 'Администраторы');
INSERT INTO `be_AdminLanguage` VALUES ('28', '2', 'LOGOUT', 'Выход');
INSERT INTO `be_AdminLanguage` VALUES ('29', '3', 'MM_USER_MANAGER', 'Users Manager');
INSERT INTO `be_AdminLanguage` VALUES ('30', '3', 'MM_PREFERENCES', 'Preferences');
INSERT INTO `be_AdminLanguage` VALUES ('37', '1', 'LM_BROWSE_PRODUCTS', 'Список продуктів');
INSERT INTO `be_AdminLanguage` VALUES ('38', '1', 'LM_ADD_PRODUCTS', 'Додати продукт');
INSERT INTO `be_AdminLanguage` VALUES ('39', '1', 'LM_CONFIGURE_PRODUCTS', 'Налаштування продуктів');
INSERT INTO `be_AdminLanguage` VALUES ('41', '1', 'LM_CONFIGURE_CONTENT', 'Налаштування контенту');
INSERT INTO `be_AdminLanguage` VALUES ('44', '2', 'LM_BROWSE_PRODUCTS', 'Просмотр продуктов');
INSERT INTO `be_AdminLanguage` VALUES ('45', '2', 'LM_ADD_PRODUCTS', 'Добавить продукт');
INSERT INTO `be_AdminLanguage` VALUES ('46', '2', 'LM_CONFIGURE_PRODUCTS', 'Настройка продуктов');
INSERT INTO `be_AdminLanguage` VALUES ('47', '2', 'LM_CONFIGURE_CONTENT', 'Настройка контента');
INSERT INTO `be_AdminLanguage` VALUES ('50', '3', 'LM_BROWSE_PRODUCTS', 'Browse products');
INSERT INTO `be_AdminLanguage` VALUES ('51', '3', 'LM_ADD_PRODUCTS', 'Add product');
INSERT INTO `be_AdminLanguage` VALUES ('52', '3', 'LM_CONFIGURE_PRODUCTS', 'Configure of products');
INSERT INTO `be_AdminLanguage` VALUES ('53', '3', 'LM_CONFIGURE_CONTENT', 'Configure of content');
INSERT INTO `be_AdminLanguage` VALUES ('54', '1', 'LM_PAGE_ADD_PAGE', 'Додати сторінку');
INSERT INTO `be_AdminLanguage` VALUES ('55', '1', 'LM_PAGE_VIEW_PAGE', 'Перегляд сторінок');
INSERT INTO `be_AdminLanguage` VALUES ('56', '1', 'LM_PAGE_ADD_PO', 'Додати об\'єкт');
INSERT INTO `be_AdminLanguage` VALUES ('57', '2', 'LM_PAGE_ADD_PAGE', 'Добавить страницу');
INSERT INTO `be_AdminLanguage` VALUES ('58', '2', 'LM_PAGE_VIEW_PAGE', 'Просмотр страниц');
INSERT INTO `be_AdminLanguage` VALUES ('59', '2', 'LM_PAGE_ADD_PO', 'Добавить объект');
INSERT INTO `be_AdminLanguage` VALUES ('60', '3', 'LM_PAGE_ADD_PAGE', 'Add page');
INSERT INTO `be_AdminLanguage` VALUES ('61', '3', 'LM_PAGE_VIEW_PAGE', 'Preview of pages');
INSERT INTO `be_AdminLanguage` VALUES ('62', '3', 'LM_PAGE_ADD_PO', 'Add object');
INSERT INTO `be_AdminLanguage` VALUES ('63', '1', 'LM_PAGE_VIEW_PO', 'Перегляд об\'єктів');
INSERT INTO `be_AdminLanguage` VALUES ('64', '1', 'SEARCH', 'Пошук');
INSERT INTO `be_AdminLanguage` VALUES ('65', '2', 'SEARCH', 'Поиск');
INSERT INTO `be_AdminLanguage` VALUES ('66', '3', 'SEARCH', 'Search');
INSERT INTO `be_AdminLanguage` VALUES ('67', '1', 'LM_PR_MENEDGLIST', 'Управління списками');
INSERT INTO `be_AdminLanguage` VALUES ('68', '1', 'LM_TREE_CONFIG', 'Налаштування меню');
INSERT INTO `be_AdminLanguage` VALUES ('69', '1', 'ADD_TEXT', 'Додати');
INSERT INTO `be_AdminLanguage` VALUES ('70', '1', 'CREATE_TEXT', 'Створити');
INSERT INTO `be_AdminLanguage` VALUES ('71', '1', 'LIST_ADD_DESCRIPTION', 'Для створення нового списку натисніть:');
INSERT INTO `be_AdminLanguage` VALUES ('72', '1', 'EDIT_TEXT', 'Редагувати');
INSERT INTO `be_AdminLanguage` VALUES ('73', '1', 'TABLE_HEAD_NAME', 'Заголовок');
INSERT INTO `be_AdminLanguage` VALUES ('74', '2', 'TABLE_HEAD_NAME', 'Заголовок');
INSERT INTO `be_AdminLanguage` VALUES ('75', '3', 'TABLE_HEAD_NAME', 'Title');
INSERT INTO `be_AdminLanguage` VALUES ('76', '1', 'TABLE_HEAD_DATE', 'Дата');
INSERT INTO `be_AdminLanguage` VALUES ('77', '2', 'TABLE_HEAD_DATE', 'Дата');
INSERT INTO `be_AdminLanguage` VALUES ('78', '3', 'TABLE_HEAD_DATE', 'Date');
INSERT INTO `be_AdminLanguage` VALUES ('79', '1', 'MM_FILE_MANAGER', 'Файл-менеджер');
INSERT INTO `be_AdminLanguage` VALUES ('80', '2', 'LM_PAGE_VIEW_PO', 'Просмотр объектов');
INSERT INTO `be_AdminLanguage` VALUES ('81', '2', 'LM_PR_MENEDGLIST', 'Управление списками');
INSERT INTO `be_AdminLanguage` VALUES ('82', '2', 'LM_TREE_CONFIG', 'Настройка меню');
INSERT INTO `be_AdminLanguage` VALUES ('83', '2', 'MM_FILE_MANAGER', 'Управление файлами');
INSERT INTO `be_AdminLanguage` VALUES ('84', '3', 'LM_PAGE_VIEW_PO', 'Preview of objects');
INSERT INTO `be_AdminLanguage` VALUES ('85', '3', 'LM_PR_MENEDGLIST', 'Lists administrats');
INSERT INTO `be_AdminLanguage` VALUES ('86', '3', 'LM_TREE_CONFIG', 'Menu settings');
INSERT INTO `be_AdminLanguage` VALUES ('87', '3', 'MM_FILE_MANAGER', 'File manager');
INSERT INTO `be_AdminLanguage` VALUES ('88', '1', 'SAVE', 'Зберегти');
INSERT INTO `be_AdminLanguage` VALUES ('89', '1', 'CANCEL', 'Скасувати');
INSERT INTO `be_AdminLanguage` VALUES ('90', '1', 'CLEAR', 'Очистити');
INSERT INTO `be_AdminLanguage` VALUES ('91', '1', 'BROWSE', 'Додати');
INSERT INTO `be_AdminLanguage` VALUES ('92', '1', 'EDIT', 'Редагувати');
INSERT INTO `be_AdminLanguage` VALUES ('93', '1', 'ADD', 'Додати');
INSERT INTO `be_AdminLanguage` VALUES ('94', '1', 'SET_BY_PROGRAMM', 'додається програмою');
INSERT INTO `be_AdminLanguage` VALUES ('95', '1', 'REQUIRED', 'обов\'язкове');
INSERT INTO `be_AdminLanguage` VALUES ('96', '1', 'CUSTOMER_SITE_URL', '');
INSERT INTO `be_AdminLanguage` VALUES ('97', '1', 'ACTIONS', 'Дії');
INSERT INTO `be_AdminLanguage` VALUES ('98', '1', 'COPY', 'Копіювати');
INSERT INTO `be_AdminLanguage` VALUES ('99', '1', 'DELETE', 'Видалити');
INSERT INTO `be_AdminLanguage` VALUES ('100', '1', 'DELETED_SUCCESSFULLY', 'Видалено успішно!');
INSERT INTO `be_AdminLanguage` VALUES ('101', '1', 'NEXT_PAGE', 'Наступна');
INSERT INTO `be_AdminLanguage` VALUES ('102', '1', 'PREVIOUS_PAGE', 'Попередня');
INSERT INTO `be_AdminLanguage` VALUES ('103', '1', 'LOADING', 'Завантаження');
INSERT INTO `be_AdminLanguage` VALUES ('104', '1', 'FILL_REQUIRED', 'Будь-ласка, заповніть всі обов\'язкові поля!');
INSERT INTO `be_AdminLanguage` VALUES ('105', '1', 'LIST_IS_FULL', 'Список містить максимальну кількість записів!');
INSERT INTO `be_AdminLanguage` VALUES ('106', '1', 'ITEM_IN_LIST', 'Данний запис вже знаходиться у списку!');
INSERT INTO `be_AdminLanguage` VALUES ('107', '1', 'FIREBUG_NOTICE', 'Firebug уповільнює роботу iProAction CMS.');
INSERT INTO `be_AdminLanguage` VALUES ('108', '1', 'DELETE_CONFIRM', 'Ви дійсно бажаєте видалити цей запис?');
INSERT INTO `be_AdminLanguage` VALUES ('109', '1', 'SAVED', 'Данні збережено успішно.');
INSERT INTO `be_AdminLanguage` VALUES ('110', '1', 'SAVING', 'Збереження');
INSERT INTO `be_AdminLanguage` VALUES ('111', '1', 'SUPPORT_TEAM', 'Служба підтримки');
INSERT INTO `be_AdminLanguage` VALUES ('112', '1', 'NO_CONNECTION', 'З\'єднання з інтернетом відсутнє!');
INSERT INTO `be_AdminLanguage` VALUES ('113', '2', 'LIST_ADD_DESCRIPTION', 'Для создания нового списка нажмите:');
INSERT INTO `be_AdminLanguage` VALUES ('114', '2', 'EDIT_TEXT', 'Редактировать');
INSERT INTO `be_AdminLanguage` VALUES ('115', '2', 'EDIT', 'Редактировать');
INSERT INTO `be_AdminLanguage` VALUES ('116', '2', 'DELETED_SUCCESSFULLY', 'Удалено успешно');
INSERT INTO `be_AdminLanguage` VALUES ('117', '2', 'FILL_REQUIRED', 'Пожалуйста, заполните все обязательные поля!');
INSERT INTO `be_AdminLanguage` VALUES ('118', '2', 'LIST_IS_FULL', 'Список содержит максимальное количество записей!');
INSERT INTO `be_AdminLanguage` VALUES ('119', '2', 'ITEM_IN_LIST', 'Данная запись уже содержится в списке!');
INSERT INTO `be_AdminLanguage` VALUES ('120', '2', 'FIREBUG_NOTICE', 'Firebug замедляет работу iProAction CMS.');
INSERT INTO `be_AdminLanguage` VALUES ('121', '2', 'DELETE_CONFIRM', 'Вы действительно желаете удалить эту запись?');
INSERT INTO `be_AdminLanguage` VALUES ('122', '3', 'LIST_ADD_DESCRIPTION', 'Fpor create new list press:');
INSERT INTO `be_AdminLanguage` VALUES ('123', '3', 'EDIT_TEXT', 'Edit');
INSERT INTO `be_AdminLanguage` VALUES ('124', '3', 'EDIT', 'Edit');
INSERT INTO `be_AdminLanguage` VALUES ('125', '3', 'DELETED_SUCCESSFULLY', 'Deleted successfully');
INSERT INTO `be_AdminLanguage` VALUES ('126', '3', 'FILL_REQUIRED', 'Please, follow all require fields!');
INSERT INTO `be_AdminLanguage` VALUES ('127', '3', 'LIST_IS_FULL', 'List has maxymum count of items!');
INSERT INTO `be_AdminLanguage` VALUES ('128', '3', 'ITEM_IN_LIST', 'This record already is in the list');
INSERT INTO `be_AdminLanguage` VALUES ('129', '3', 'FIREBUG_NOTICE', 'Firebug slows work iProAction CMS.');
INSERT INTO `be_AdminLanguage` VALUES ('130', '3', 'DELETE_CONFIRM', 'Do you realy delete this record?');
INSERT INTO `be_AdminLanguage` VALUES ('131', '1', 'NO_RESULTS', 'Не знайдено жодного запису');
INSERT INTO `be_AdminLanguage` VALUES ('132', '1', 'RENAME', 'Перейменувати');
INSERT INTO `be_AdminLanguage` VALUES ('133', '1', 'PREVIEW', 'Переглянути');
INSERT INTO `be_AdminLanguage` VALUES ('134', '2', 'SAVE', 'Сохранить');
INSERT INTO `be_AdminLanguage` VALUES ('135', '2', 'SET_BY_PROGRAMM', 'добавляется программой');
INSERT INTO `be_AdminLanguage` VALUES ('136', '2', 'REQUIRED', 'обязательное');
INSERT INTO `be_AdminLanguage` VALUES ('137', '2', 'PREVIOUS_PAGE', 'Предыдущая');
INSERT INTO `be_AdminLanguage` VALUES ('138', '2', 'SAVED', 'Данные удачно сохранены');
INSERT INTO `be_AdminLanguage` VALUES ('139', '2', 'SAVING', 'Сохранение');
INSERT INTO `be_AdminLanguage` VALUES ('140', '2', 'SUPPORT_TEAM', 'Служба поддержки');
INSERT INTO `be_AdminLanguage` VALUES ('141', '2', 'RENAME', 'Переименовать');
INSERT INTO `be_AdminLanguage` VALUES ('142', '2', 'PREVIEW', 'Посмотреть');
INSERT INTO `be_AdminLanguage` VALUES ('143', '3', 'SAVE', 'Save');
INSERT INTO `be_AdminLanguage` VALUES ('144', '3', 'SET_BY_PROGRAMM', 'set by program');
INSERT INTO `be_AdminLanguage` VALUES ('145', '3', 'REQUIRED', 'Required');
INSERT INTO `be_AdminLanguage` VALUES ('146', '3', 'PREVIOUS_PAGE', 'Previous');
INSERT INTO `be_AdminLanguage` VALUES ('147', '3', 'SAVED', 'Data succesfully saved');
INSERT INTO `be_AdminLanguage` VALUES ('148', '3', 'SAVING', 'Saving');
INSERT INTO `be_AdminLanguage` VALUES ('149', '3', 'SUPPORT_TEAM', 'Support team');
INSERT INTO `be_AdminLanguage` VALUES ('150', '3', 'RENAME', 'Rename');
INSERT INTO `be_AdminLanguage` VALUES ('151', '3', 'PREVIEW', 'Preview');
INSERT INTO `be_AdminLanguage` VALUES ('152', '1', 'TABLE_HEAD_FILE', 'Файл');
INSERT INTO `be_AdminLanguage` VALUES ('153', '1', 'DYNAMIC_LISTS', 'Динамічні списки');
INSERT INTO `be_AdminLanguage` VALUES ('155', '2', 'DYNAMIC_LISTS', 'Динамические списки');
INSERT INTO `be_AdminLanguage` VALUES ('157', '3', 'DYNAMIC_LISTS', 'Dynamic lists');
INSERT INTO `be_AdminLanguage` VALUES ('159', '2', 'ADD_TEXT', 'Добавить');
INSERT INTO `be_AdminLanguage` VALUES ('160', '2', 'CREATE_TEXT', 'Создать');
INSERT INTO `be_AdminLanguage` VALUES ('161', '2', 'CANCEL', 'Оменить');
INSERT INTO `be_AdminLanguage` VALUES ('162', '2', 'CLEAR', 'Очистить');
INSERT INTO `be_AdminLanguage` VALUES ('163', '2', 'BROWSE', 'Добавить');
INSERT INTO `be_AdminLanguage` VALUES ('164', '2', 'ADD', 'Добавить');
INSERT INTO `be_AdminLanguage` VALUES ('166', '2', 'ACTIONS', 'Действия');
INSERT INTO `be_AdminLanguage` VALUES ('167', '2', 'COPY', 'Копировать');
INSERT INTO `be_AdminLanguage` VALUES ('168', '2', 'DELETE', 'Удалить');
INSERT INTO `be_AdminLanguage` VALUES ('169', '3', 'ADD_TEXT', 'Add');
INSERT INTO `be_AdminLanguage` VALUES ('170', '3', 'CREATE_TEXT', 'Create');
INSERT INTO `be_AdminLanguage` VALUES ('171', '3', 'CANCEL', 'Cancel');
INSERT INTO `be_AdminLanguage` VALUES ('172', '3', 'CLEAR', 'Clear');
INSERT INTO `be_AdminLanguage` VALUES ('173', '3', 'BROWSE', 'Browse');
INSERT INTO `be_AdminLanguage` VALUES ('174', '3', 'ADD', 'Add');
INSERT INTO `be_AdminLanguage` VALUES ('175', '3', 'CUSTOMER_SITE_URL', '');
INSERT INTO `be_AdminLanguage` VALUES ('176', '3', 'ACTIONS', 'Actions');
INSERT INTO `be_AdminLanguage` VALUES ('177', '3', 'COPY', 'Copy');
INSERT INTO `be_AdminLanguage` VALUES ('178', '3', 'DELETE', 'Delete');
INSERT INTO `be_AdminLanguage` VALUES ('179', '2', 'CUSTOMER_SITE_URL', '');
INSERT INTO `be_AdminLanguage` VALUES ('180', '1', 'VIEW', 'Перегляд');
INSERT INTO `be_AdminLanguage` VALUES ('181', '1', 'FILEMANAGER_ALERT_1', 'Файл з таким ім\'ям вже існує. Завантажений файл збережено як');
INSERT INTO `be_AdminLanguage` VALUES ('182', '2', 'FILEMANAGER_ALERT_1', 'Файл с таким именем уже существует. Загруженный файл переименован на');
INSERT INTO `be_AdminLanguage` VALUES ('183', '3', 'FILEMANAGER_ALERT_1', 'A file with the same name is already available. The uploaded file has been renamed to');
INSERT INTO `be_AdminLanguage` VALUES ('184', '1', 'FILEMANAGER_ALERT_2', 'Невірний файл. Файл з таким розширенням не може знаходитись в даній директорії');
INSERT INTO `be_AdminLanguage` VALUES ('185', '2', 'FILEMANAGER_ALERT_2', 'Неверный файл. Файл с таким расширением не может находится в данной директории');
INSERT INTO `be_AdminLanguage` VALUES ('186', '3', 'FILEMANAGER_ALERT_2', 'Invalid file');
INSERT INTO `be_AdminLanguage` VALUES ('187', '1', 'FILEMANAGER_ALERT_3', 'В імені файлу не повинні бути присутні символи кирилиці');
INSERT INTO `be_AdminLanguage` VALUES ('188', '2', 'FILEMANAGER_ALERT_3', 'Имя файла не должно содержать символы кирилицы');
INSERT INTO `be_AdminLanguage` VALUES ('189', '3', 'FILEMANAGER_ALERT_3', 'The file name must not contain characters of Cyrillic');
INSERT INTO `be_AdminLanguage` VALUES ('190', '1', 'FILEMANAGER_ALERT_4', 'Помилка завантаження файлу. Код помилки:');
INSERT INTO `be_AdminLanguage` VALUES ('191', '2', 'FILEMANAGER_ALERT_4', 'Ошибка при загрузке файла. Номер ошибки:');
INSERT INTO `be_AdminLanguage` VALUES ('192', '3', 'FILEMANAGER_ALERT_4', 'Error on file upload. Error number:');
INSERT INTO `be_AdminLanguage` VALUES ('193', '1', 'FILEMANAGER_2', 'Завантажити новий файл в дану директорію');
INSERT INTO `be_AdminLanguage` VALUES ('194', '1', 'FILEMANAGER_3', 'Завантаження ...');
INSERT INTO `be_AdminLanguage` VALUES ('195', '2', 'FILEMANAGER_2', 'Загрузить новый фал в эту директорию');
INSERT INTO `be_AdminLanguage` VALUES ('196', '2', 'FILEMANAGER_3', 'Загрузка ...');
INSERT INTO `be_AdminLanguage` VALUES ('197', '3', 'FILEMANAGER_2', 'Upload a new file in this folder');
INSERT INTO `be_AdminLanguage` VALUES ('198', '3', 'FILEMANAGER_3', 'Uploading ...');
INSERT INTO `be_AdminLanguage` VALUES ('199', '1', 'FILEMANAGER_ALERT_5', 'Будь-ласка виберіть файл на Вашому комп\'ютері');
INSERT INTO `be_AdminLanguage` VALUES ('200', '2', 'FILEMANAGER_ALERT_5', 'Пожалуйста выберите файл на Вашем компьютере');
INSERT INTO `be_AdminLanguage` VALUES ('201', '3', 'FILEMANAGER_ALERT_5', 'Please select a file from your computer');
INSERT INTO `be_AdminLanguage` VALUES ('202', '1', 'FILEMANAGER_4', 'Додати файл:');
INSERT INTO `be_AdminLanguage` VALUES ('203', '2', 'FILEMANAGER_4', 'Добавить файл:');
INSERT INTO `be_AdminLanguage` VALUES ('204', '3', 'FILEMANAGER_4', 'Add a file to this folder :');
INSERT INTO `be_AdminLanguage` VALUES ('205', '3', 'FILEMANAGER_ALERT_6', 'Type the name of the new folder:');
INSERT INTO `be_AdminLanguage` VALUES ('206', '1', 'FILEMANAGER_ALERT_6', 'Введіть ім\'я нової директорії:');
INSERT INTO `be_AdminLanguage` VALUES ('207', '2', 'FILEMANAGER_ALERT_6', 'Введите имя новой директории:');
INSERT INTO `be_AdminLanguage` VALUES ('208', '3', 'FILEMANAGER_5', 'Create folder');
INSERT INTO `be_AdminLanguage` VALUES ('209', '1', 'FILEMANAGER_5', 'Створити теку');
INSERT INTO `be_AdminLanguage` VALUES ('210', '2', 'FILEMANAGER_5', 'Создать папку');
INSERT INTO `be_AdminLanguage` VALUES ('211', '3', 'FILEMANAGER_6', 'Upload');
INSERT INTO `be_AdminLanguage` VALUES ('212', '1', 'FILEMANAGER_6', 'Завантажити');
INSERT INTO `be_AdminLanguage` VALUES ('213', '2', 'FILEMANAGER_6', 'Загрузить');
INSERT INTO `be_AdminLanguage` VALUES ('214', '3', 'FILEMANAGER_1', 'Resource Type');
INSERT INTO `be_AdminLanguage` VALUES ('215', '1', 'FILEMANAGER_1', 'Тип ресурсу');
INSERT INTO `be_AdminLanguage` VALUES ('216', '2', 'FILEMANAGER_1', 'Тип ресурса');
INSERT INTO `be_AdminLanguage` VALUES ('217', '3', 'FILEMANAGER_ALERT_7', 'Are you sure, that whant delete selected file?');
INSERT INTO `be_AdminLanguage` VALUES ('218', '1', 'FILEMANAGER_ALERT_7', 'Ви впевнені, що хочете видалити вибраний файл?');
INSERT INTO `be_AdminLanguage` VALUES ('219', '2', 'FILEMANAGER_ALERT_7', 'Вы уверены, что хотите удалить выбранный файл?');
INSERT INTO `be_AdminLanguage` VALUES ('220', '3', 'FILEMANAGER_ALERT_8', 'Enter please filename !!!');
INSERT INTO `be_AdminLanguage` VALUES ('221', '1', 'FILEMANAGER_ALERT_8', 'Будь-ласка введіть ім\'я файлу !!!');
INSERT INTO `be_AdminLanguage` VALUES ('222', '2', 'FILEMANAGER_ALERT_8', 'Пожалуйста введите имя файла !!!');
INSERT INTO `be_AdminLanguage` VALUES ('223', '3', 'FILEMANAGER_ALERT_9', 'Enter please dirname !!!');
INSERT INTO `be_AdminLanguage` VALUES ('224', '1', 'FILEMANAGER_ALERT_9', 'Будь-ласка введіть ім\'я директорії !!!');
INSERT INTO `be_AdminLanguage` VALUES ('225', '2', 'FILEMANAGER_ALERT_9', 'Пожалуйста введите имя директории !!!');
INSERT INTO `be_AdminLanguage` VALUES ('226', '1', 'FILEMANAGER_7', 'Нове ім\'я файлу:');
INSERT INTO `be_AdminLanguage` VALUES ('227', '2', 'FILEMANAGER_7', 'Новое имя файла:');
INSERT INTO `be_AdminLanguage` VALUES ('228', '3', 'FILEMANAGER_7', 'New filename:');
INSERT INTO `be_AdminLanguage` VALUES ('229', '3', 'FILEMANAGER_8', 'New foldername:');
INSERT INTO `be_AdminLanguage` VALUES ('230', '1', 'FILEMANAGER_8', 'Нове ім\'я директорії:');
INSERT INTO `be_AdminLanguage` VALUES ('231', '2', 'FILEMANAGER_8', 'Новое имя директории:');
INSERT INTO `be_AdminLanguage` VALUES ('232', '3', 'FILEMANAGER_ALERT_10', 'Fatal error: Do not know, what resourse must be edit(file or folder)');
INSERT INTO `be_AdminLanguage` VALUES ('233', '1', 'FILEMANAGER_ALERT_10', 'Помилка: Невідомий ресурс, який повинен бути змінени(файл чи директорія)');
INSERT INTO `be_AdminLanguage` VALUES ('234', '2', 'FILEMANAGER_ALERT_10', 'Ошибка: Неизвестный ресурс, который должен быть изменен(файл или директория)');
INSERT INTO `be_AdminLanguage` VALUES ('235', '3', 'FILE', 'file');
INSERT INTO `be_AdminLanguage` VALUES ('236', '1', 'FILE', 'файл');
INSERT INTO `be_AdminLanguage` VALUES ('237', '2', 'FILE', 'файл');
INSERT INTO `be_AdminLanguage` VALUES ('238', '3', 'FOLDER', 'folder');
INSERT INTO `be_AdminLanguage` VALUES ('239', '1', 'FOLDER', 'директорія');
INSERT INTO `be_AdminLanguage` VALUES ('240', '2', 'FOLDER', 'директория');
INSERT INTO `be_AdminLanguage` VALUES ('241', '3', 'ERROR', 'Error');
INSERT INTO `be_AdminLanguage` VALUES ('242', '1', 'ERROR', 'Помилка');
INSERT INTO `be_AdminLanguage` VALUES ('243', '2', 'ERROR', 'Ошибка');
INSERT INTO `be_AdminLanguage` VALUES ('244', '3', 'FILEMANAGER_ALERT_11_1', 'not can rename as');
INSERT INTO `be_AdminLanguage` VALUES ('245', '1', 'FILEMANAGER_ALERT_11_1', 'не може бути перейменований як');
INSERT INTO `be_AdminLanguage` VALUES ('246', '2', 'FILEMANAGER_ALERT_11_1', 'не может быть переименован как');
INSERT INTO `be_AdminLanguage` VALUES ('247', '3', 'MAYBE', 'maybe');
INSERT INTO `be_AdminLanguage` VALUES ('248', '1', 'MAYBE', 'можливо');
INSERT INTO `be_AdminLanguage` VALUES ('249', '2', 'LOADING', 'Загрузка');
INSERT INTO `be_AdminLanguage` VALUES ('250', '2', 'MAYBE', 'может быть');
INSERT INTO `be_AdminLanguage` VALUES ('251', '3', 'LOADING', 'Loading');
INSERT INTO `be_AdminLanguage` VALUES ('252', '3', 'FILEMANAGER_ALERT_11_3', 'is  already exits');
INSERT INTO `be_AdminLanguage` VALUES ('253', '1', 'FILEMANAGER_ALERT_11_3', 'вже існує');
INSERT INTO `be_AdminLanguage` VALUES ('254', '2', 'FILEMANAGER_ALERT_11_3', 'уже существует');
INSERT INTO `be_AdminLanguage` VALUES ('255', '3', 'OR', 'or');
INSERT INTO `be_AdminLanguage` VALUES ('256', '1', 'OR', 'чи');
INSERT INTO `be_AdminLanguage` VALUES ('257', '2', 'NEXT_PAGE', 'Следующая');
INSERT INTO `be_AdminLanguage` VALUES ('258', '2', 'NO_CONNECTION', 'Соединение с Интернетом отсутсвует');
INSERT INTO `be_AdminLanguage` VALUES ('259', '2', 'NO_RESULTS', 'Не найдено ни одной записи');
INSERT INTO `be_AdminLanguage` VALUES ('260', '2', 'OR', 'или');
INSERT INTO `be_AdminLanguage` VALUES ('261', '3', 'NEXT_PAGE', 'Next');
INSERT INTO `be_AdminLanguage` VALUES ('262', '3', 'NO_CONNECTION', 'No connection with Internet');
INSERT INTO `be_AdminLanguage` VALUES ('263', '3', 'NO_RESULTS', 'Did not find recordes');
INSERT INTO `be_AdminLanguage` VALUES ('264', '3', 'AND', 'and');
INSERT INTO `be_AdminLanguage` VALUES ('265', '1', 'AND', 'та');
INSERT INTO `be_AdminLanguage` VALUES ('266', '2', 'AND', 'и');
INSERT INTO `be_AdminLanguage` VALUES ('267', '3', 'FILEMANAGER_ALERT_11_2', 'was rename(delete) earn');
INSERT INTO `be_AdminLanguage` VALUES ('268', '1', 'FILEMANAGER_ALERT_11_2', 'був перейменований(видалений) раніше');
INSERT INTO `be_AdminLanguage` VALUES ('269', '2', 'FILEMANAGER_ALERT_11_2', 'был переименован(удален) раньше');
INSERT INTO `be_AdminLanguage` VALUES ('270', '3', 'FILEMANAGER_ALERT_12_1', '(copy)');
INSERT INTO `be_AdminLanguage` VALUES ('271', '1', 'FILEMANAGER_ALERT_12_1', '(копія)');
INSERT INTO `be_AdminLanguage` VALUES ('272', '2', 'FILEMANAGER_ALERT_12_1', '(копия)');
INSERT INTO `be_AdminLanguage` VALUES ('273', '3', 'FILEMANAGER_ALERT_13_1', 'Don\\\'t delete');
INSERT INTO `be_AdminLanguage` VALUES ('274', '1', 'FILEMANAGER_ALERT_13_1', 'Неможливо видалити');
INSERT INTO `be_AdminLanguage` VALUES ('275', '2', 'FILEMANAGER_ALERT_13_1', 'Невозможно удалить');
INSERT INTO `be_AdminLanguage` VALUES ('276', '3', 'FILEMANAGER_ALERT_13_2', 'was already delete earn');
INSERT INTO `be_AdminLanguage` VALUES ('277', '1', 'FILEMANAGER_ALERT_13_2', 'був видалений раніше');
INSERT INTO `be_AdminLanguage` VALUES ('278', '2', 'FILEMANAGER_ALERT_13_2', 'был удален раньше');
INSERT INTO `be_AdminLanguage` VALUES ('279', '3', 'FILEMANAGER_ALERT_13_3', 'or one of her components(file(files) or folder(folders)) or folder was already delete earn');
INSERT INTO `be_AdminLanguage` VALUES ('280', '1', 'FILEMANAGER_ALERT_13_3', 'чи один з її компонентів(файл(файли) чи директорія(директорії)) чи директорія була видалена раніше');
INSERT INTO `be_AdminLanguage` VALUES ('281', '2', 'FILEMANAGER_ALERT_13_3', 'или один из ее компонентов(файл(файли) чи директория(директории)) или директория была удалена раньше');
INSERT INTO `be_AdminLanguage` VALUES ('282', '3', 'FILEMANAGER_ALERT_6_1', 'Please type the folder name');
INSERT INTO `be_AdminLanguage` VALUES ('283', '1', 'FILEMANAGER_ALERT_6_1', 'Будь-ласка введіть назву директорії');
INSERT INTO `be_AdminLanguage` VALUES ('284', '2', 'FILEMANAGER_ALERT_6_1', 'Пожалуйста введите название директории');
INSERT INTO `be_AdminLanguage` VALUES ('285', '3', 'FILEMANAGER_ALERT_14', 'Folder already exists');
INSERT INTO `be_AdminLanguage` VALUES ('286', '3', 'FILEMANAGER_ALERT_15', 'Invalid folder name');
INSERT INTO `be_AdminLanguage` VALUES ('287', '3', 'FILEMANAGER_ALERT_16', 'You have no permissions to create the folder');
INSERT INTO `be_AdminLanguage` VALUES ('288', '3', 'FILEMANAGER_ALERT_17', 'Unknown error creating folder');
INSERT INTO `be_AdminLanguage` VALUES ('289', '3', 'FILEMANAGER_ALERT_18', 'Error on your request. Error number: ');
INSERT INTO `be_AdminLanguage` VALUES ('290', '1', 'FILEMANAGER_ALERT_14', 'Директорія вже існує');
INSERT INTO `be_AdminLanguage` VALUES ('291', '1', 'FILEMANAGER_ALERT_15', 'Некоректе ім\'я директорії');
INSERT INTO `be_AdminLanguage` VALUES ('292', '1', 'FILEMANAGER_ALERT_16', 'Ви не маєте права створювання директорії');
INSERT INTO `be_AdminLanguage` VALUES ('293', '1', 'FILEMANAGER_ALERT_17', 'Невідома помилка при створенні директорії');
INSERT INTO `be_AdminLanguage` VALUES ('294', '1', 'FILEMANAGER_ALERT_18', 'Помилка Вашого запиту. Код помилки: ');
INSERT INTO `be_AdminLanguage` VALUES ('295', '2', 'FILEMANAGER_ALERT_14', 'Директория уже существует');
INSERT INTO `be_AdminLanguage` VALUES ('296', '2', 'FILEMANAGER_ALERT_15', 'Некоректное имя директории');
INSERT INTO `be_AdminLanguage` VALUES ('297', '2', 'FILEMANAGER_ALERT_16', 'Вы не имеете разрешения создавать директорию');
INSERT INTO `be_AdminLanguage` VALUES ('298', '2', 'FILEMANAGER_ALERT_17', 'Неизвестная ошибка при создании директории');
INSERT INTO `be_AdminLanguage` VALUES ('299', '2', 'FILEMANAGER_ALERT_18', 'Ошибка Вашего запроса. Номер ошибки: ');
INSERT INTO `be_AdminLanguage` VALUES ('300', '3', 'FILEMANAGER_ALERT_19', 'Are you sure, that whant deleteselected folder?');
INSERT INTO `be_AdminLanguage` VALUES ('301', '1', 'FILEMANAGER_ALERT_19', 'Ви впевнені, що хочете видалити обрану директорію?');
INSERT INTO `be_AdminLanguage` VALUES ('302', '2', 'FILEMANAGER_ALERT_19', 'Вы уверены, что хотите удалить выбранную директорию?');
INSERT INTO `be_AdminLanguage` VALUES ('303', '1', 'ACTIVE', 'Активний');
INSERT INTO `be_AdminLanguage` VALUES ('304', '1', 'NOT_ACTIVE', 'Неактивний');
INSERT INTO `be_AdminLanguage` VALUES ('305', '1', 'UP', 'Вверх');
INSERT INTO `be_AdminLanguage` VALUES ('306', '1', 'DOWN', 'Вниз');
INSERT INTO `be_AdminLanguage` VALUES ('307', '1', 'SELECT_ITEM_PLEASE', 'Спочатку виберіть запис, будь-ласка!');
INSERT INTO `be_AdminLanguage` VALUES ('308', '1', 'MASTER_PAGES', 'Майстер сторінки');
INSERT INTO `be_AdminLanguage` VALUES ('309', '1', 'LM_LIST_MASTER_PAGE', 'Шаблони');
INSERT INTO `be_AdminLanguage` VALUES ('310', '1', 'LM_ADD_MASTER_PAGE', 'Додати &quot;Master Page&quot;');
INSERT INTO `be_AdminLanguage` VALUES ('311', '2', 'LM_ADD_MASTER_PAGE', 'Добавить &quot;Master Page&quot;');
INSERT INTO `be_AdminLanguage` VALUES ('312', '3', 'LM_ADD_MASTER_PAGE', 'Add &quot;Master Page&quot;');
INSERT INTO `be_AdminLanguage` VALUES ('313', '2', 'LM_LIST_MASTER_PAGE', 'Шаблоны');
INSERT INTO `be_AdminLanguage` VALUES ('314', '3', 'LM_LIST_MASTER_PAGE', 'Templates');
INSERT INTO `be_AdminLanguage` VALUES ('315', '1', 'VIEW', 'Перегляд');
INSERT INTO `be_AdminLanguage` VALUES ('316', '2', 'ACTIVE', 'Активный');
INSERT INTO `be_AdminLanguage` VALUES ('317', '3', 'ACTIVE', 'Active');
INSERT INTO `be_AdminLanguage` VALUES ('318', '2', 'DOWN', 'Вниз');
INSERT INTO `be_AdminLanguage` VALUES ('319', '3', 'DOWN', 'Down');
INSERT INTO `be_AdminLanguage` VALUES ('320', '2', 'MASTER_PAGES', 'Мастер страницы');
INSERT INTO `be_AdminLanguage` VALUES ('321', '3', 'MASTER_PAGES', 'Master of page');
INSERT INTO `be_AdminLanguage` VALUES ('322', '2', 'NOT_ACTIVE', 'Неактивный');
INSERT INTO `be_AdminLanguage` VALUES ('323', '3', 'NOT_ACTIVE', 'No active');
INSERT INTO `be_AdminLanguage` VALUES ('324', '2', 'VIEW', 'Просмотр');
INSERT INTO `be_AdminLanguage` VALUES ('325', '3', 'VIEW', 'Preview');
INSERT INTO `be_AdminLanguage` VALUES ('326', '2', 'TABLE_HEAD_FILE', 'Файл');
INSERT INTO `be_AdminLanguage` VALUES ('327', '2', 'UP', 'Вверх');
INSERT INTO `be_AdminLanguage` VALUES ('328', '2', 'SELECT_ITEM_PLEASE', 'Сначала выберите запись, пожалуйста');
INSERT INTO `be_AdminLanguage` VALUES ('329', '3', 'TABLE_HEAD_FILE', 'File');
INSERT INTO `be_AdminLanguage` VALUES ('330', '3', 'UP', 'Up');
INSERT INTO `be_AdminLanguage` VALUES ('331', '3', 'SELECT_ITEM_PLEASE', 'First of all select record, please');
INSERT INTO `be_AdminLanguage` VALUES ('332', '1', 'TABLE_RSS_RESOURCE_NAME', 'Назва RSS ресурсу');
INSERT INTO `be_AdminLanguage` VALUES ('333', '2', 'TABLE_RSS_RESOURCE_NAME', 'Название RSS-источинка');
INSERT INTO `be_AdminLanguage` VALUES ('334', '3', 'TABLE_RSS_RESOURCE_NAME', 'RSS-resource name');
INSERT INTO `be_AdminLanguage` VALUES ('335', '1', 'TABLE_RSS_LINK', 'Лінк на RSS-ресурс');
INSERT INTO `be_AdminLanguage` VALUES ('336', '0', 'TABLE_RSS_LINK', null);
INSERT INTO `be_AdminLanguage` VALUES ('337', '2', 'TABLE_RSS_LINK', 'Ссылка на RSS-ресурс');
INSERT INTO `be_AdminLanguage` VALUES ('338', '3', 'TABLE_RSS_LINK', 'Link to RSS-resource');
INSERT INTO `be_AdminLanguage` VALUES ('339', '1', 'TABLE_RSS_ALTTEXT', 'ALT-текст');
INSERT INTO `be_AdminLanguage` VALUES ('340', '2', 'TABLE_RSS_ALTTEXT', 'ALT-текст');
INSERT INTO `be_AdminLanguage` VALUES ('341', '3', 'TABLE_RSS_ALTTEXT', 'ALT-text');
INSERT INTO `be_AdminLanguage` VALUES ('342', '1', 'LM_CLEAR_CACHE', 'Очистити кеш');
INSERT INTO `be_AdminLanguage` VALUES ('343', '1', 'MM_USERSMANAGE', 'Управління користувачами');
INSERT INTO `be_AdminLanguage` VALUES ('344', '1', 'LM_USERS', 'Користувачі');
INSERT INTO `be_AdminLanguage` VALUES ('345', '1', 'AD_SEARCH', 'Пошук оголошень');
INSERT INTO `be_AdminLanguage` VALUES ('346', '1', 'LM_AD', 'Оголошення');
INSERT INTO `be_AdminLanguage` VALUES ('347', '1', 'LM_ADD_PRODUCT', 'Додати');
INSERT INTO `be_AdminLanguage` VALUES ('348', '1', 'LM_PRODUCT_MANAGER', 'Продукти');
INSERT INTO `be_AdminLanguage` VALUES ('349', '1', 'MM_ORDER_MANAGER', 'Замовлення');
INSERT INTO `be_AdminLanguage` VALUES ('350', '1', 'LM_ORDER_MANAGER', 'Замовлення');
INSERT INTO `be_AdminLanguage` VALUES ('351', '1', 'FROM', 'Від');
INSERT INTO `be_AdminLanguage` VALUES ('352', '1', 'TO', 'До');
INSERT INTO `be_AdminLanguage` VALUES ('353', '1', 'PRODUCTS_CATEGORIES', 'Категорії продукції');
INSERT INTO `be_AdminLanguage` VALUES ('354', '1', 'ADD_MODULE', 'Додати модуль');
INSERT INTO `be_AdminLanguage` VALUES ('355', '1', 'PRODUCTS', 'Продукти');
INSERT INTO `be_AdminLanguage` VALUES ('356', '1', 'ADVERTISEMENTS', 'Оголошення');
INSERT INTO `be_AdminLanguage` VALUES ('357', '1', 'ADD_ITEM', 'Додати елемент');
INSERT INTO `be_AdminLanguage` VALUES ('358', '1', 'ADD_CATEGORY', 'Додати категорію');
INSERT INTO `be_AdminLanguage` VALUES ('359', '1', 'ADD_SUBCATEGORY', 'Додати підкатегорію');
INSERT INTO `be_AdminLanguage` VALUES ('360', '1', 'PRODUCT_TYPE', 'Тип продукту');
INSERT INTO `be_AdminLanguage` VALUES ('361', '1', 'COUNT_AVALIBLE', 'Кількість доступних');
INSERT INTO `be_AdminLanguage` VALUES ('362', '1', 'COUNT_ORDERED', 'Кількість замовлених');
INSERT INTO `be_AdminLanguage` VALUES ('363', '1', 'VARIATION_TYPE', 'Тип варіації');
INSERT INTO `be_AdminLanguage` VALUES ('364', '1', 'SELECT_VARIATION', 'Оберіть атрибут');
INSERT INTO `be_AdminLanguage` VALUES ('365', '1', 'NEW_VARIATION_NAME', 'Назва нового атрибуту');
INSERT INTO `be_AdminLanguage` VALUES ('366', '1', 'NEW_VARIATION_ITEM', 'Запис нового атрибуту');
INSERT INTO `be_AdminLanguage` VALUES ('367', '1', 'ADD_TO_LIST', 'Додати до списку');
INSERT INTO `be_AdminLanguage` VALUES ('368', '1', 'NEW_VARIATION_ITEMS', 'Записи атрибуту');
INSERT INTO `be_AdminLanguage` VALUES ('369', '1', 'ADD_PRODUCT_ATTRIBUTE', 'Додати атрибут продукту...');
INSERT INTO `be_AdminLanguage` VALUES ('370', '1', 'ADD_ATTRIBUTE_DESCRIPTION', 'Додайте список атрибутів для створення набору продуктів. Максимально допустима кількість варіацій атрибутів - 3');
INSERT INTO `be_AdminLanguage` VALUES ('371', '1', 'SELECT_VARIATION_DESCRIPTION', 'Виберіть з випадаючого списку існуючий атрибут продукту. Після підвантаження варіантів атрибуту оберіть потрібні варіанти та натисніть &quot;Зберегти&quot;. Якщо необхідного атрибуту в списку немає і його необхідно додати -  оберіть пункт &quot;Новий атрибут&quot; у випадаючому списку.');
INSERT INTO `be_AdminLanguage` VALUES ('372', '1', 'ADD_VARIATION_ITEM_DESCRIPTION', 'Введіть в поле &quot;Запис нового атрибуту&quot; різновид атрибуту продукту. Після цього натисніть &quot;Додати&quot;, запис додасться до списку &quot;Записи атрибуту&quot;');
INSERT INTO `be_AdminLanguage` VALUES ('373', '1', 'PRODUCTS_ATTRIBUTES', 'Атрибути продуктів');
INSERT INTO `be_AdminLanguage` VALUES ('374', '1', 'VARIATION_ADDITION_NEW', 'Додавання нового атрибуту');
INSERT INTO `be_AdminLanguage` VALUES ('375', '1', 'VARIATION_ADDITION_EXIST', 'Вибір з існуючих атрибутів');
INSERT INTO `be_AdminLanguage` VALUES ('376', '1', 'SELECT_VARIATION_ADDITION_TYPE', '--- Оберіть варіант додавання атрубуту продукту ---');
INSERT INTO `be_AdminLanguage` VALUES ('377', '1', 'CURR_PRODUCT_ATTRIBUTES', 'Атрибути поточного продукту');
INSERT INTO `be_AdminLanguage` VALUES ('378', '1', 'RELATED_PRODUCTS', 'Повязані продукти');
INSERT INTO `be_AdminLanguage` VALUES ('379', '1', 'PRODUCT_NAME', 'Назва продукту');
INSERT INTO `be_AdminLanguage` VALUES ('380', '1', 'NO_ADDWORDS_FOUNDED', 'Введенного слова в базі не знайдено. Додати його?');
INSERT INTO `be_AdminLanguage` VALUES ('381', '1', 'YES', 'Так');
INSERT INTO `be_AdminLanguage` VALUES ('382', '1', 'NO', 'Ні');
INSERT INTO `be_AdminLanguage` VALUES ('383', '2', 'VARIATION_TYPE', 'Тип вариации');
INSERT INTO `be_AdminLanguage` VALUES ('384', '2', 'VARIATION_ADDITION_NEW', 'Добавление нового атрибута');
INSERT INTO `be_AdminLanguage` VALUES ('385', '2', 'VARIATION_ADDITION_EXIST', 'Выбор из существующих');
INSERT INTO `be_AdminLanguage` VALUES ('386', '2', 'YES', 'Да');
INSERT INTO `be_AdminLanguage` VALUES ('387', '2', 'ADD_MODULE', 'Добавить модуль');
INSERT INTO `be_AdminLanguage` VALUES ('388', '2', 'ADD_ITEM', 'Добавить запись');
INSERT INTO `be_AdminLanguage` VALUES ('389', '2', 'ADD_CATEGORY', 'Добавить категорию');
INSERT INTO `be_AdminLanguage` VALUES ('390', '2', 'ADD_SUBCATEGORY', 'Добавить подкатегорию');
INSERT INTO `be_AdminLanguage` VALUES ('391', '2', 'ADD_PRODUCT_ATTRIBUTE', 'Добавить атрибут продукта...');
INSERT INTO `be_AdminLanguage` VALUES ('392', '2', 'ADD_ATTRIBUTE_DESCRIPTION', 'Добавьте список атрибутов для создания набора продуктов. Максимально допустимое количество вариаций - 3');
INSERT INTO `be_AdminLanguage` VALUES ('393', '2', 'AD_SEARCH', 'Поиск объявлений');
INSERT INTO `be_AdminLanguage` VALUES ('394', '2', 'ADVERTISEMENTS', 'Объявление');
INSERT INTO `be_AdminLanguage` VALUES ('395', '2', 'COUNT_AVALIBLE', 'Количество доступных');
INSERT INTO `be_AdminLanguage` VALUES ('396', '2', 'ADD_TO_LIST', 'Добавить к списку');
INSERT INTO `be_AdminLanguage` VALUES ('397', '2', 'ADD_VARIATION_ITEM_DESCRIPTION', '');
INSERT INTO `be_AdminLanguage` VALUES ('398', '2', 'COUNT_ORDERED', 'Количество заказнных');
INSERT INTO `be_AdminLanguage` VALUES ('399', '2', 'CURR_PRODUCT_ATTRIBUTES', 'Атрибут текущего продукта');
INSERT INTO `be_AdminLanguage` VALUES ('400', '2', 'FROM', 'От');
INSERT INTO `be_AdminLanguage` VALUES ('401', '2', 'LM_CLEAR_CACHE', 'Очистить кеш');
INSERT INTO `be_AdminLanguage` VALUES ('402', '2', 'LM_AD', '');
INSERT INTO `be_AdminLanguage` VALUES ('403', '2', 'LM_ADD_PRODUCT', 'Добавить');
INSERT INTO `be_AdminLanguage` VALUES ('404', '2', 'LM_USERS', 'Пользователи');
INSERT INTO `be_AdminLanguage` VALUES ('405', '2', 'LM_PRODUCT_MANAGER', 'Продукты');
INSERT INTO `be_AdminLanguage` VALUES ('406', '2', 'LM_ORDER_MANAGER', 'Заказы');
INSERT INTO `be_AdminLanguage` VALUES ('407', '2', 'MM_ORDER_MANAGER', 'Заказы');
INSERT INTO `be_AdminLanguage` VALUES ('408', '2', 'MM_USERSMANAGE', 'Управление пользователями');
INSERT INTO `be_AdminLanguage` VALUES ('409', '2', 'NEW_VARIATION_NAME', 'Название нового атрибута');
INSERT INTO `be_AdminLanguage` VALUES ('410', '2', 'NEW_VARIATION_ITEM', '');
INSERT INTO `be_AdminLanguage` VALUES ('411', '2', 'NEW_VARIATION_ITEMS', '');
INSERT INTO `be_AdminLanguage` VALUES ('412', '2', 'NO_ADDWORDS_FOUNDED', 'Введенное слово в базе не найдено. Добавить его?');
INSERT INTO `be_AdminLanguage` VALUES ('413', '2', 'NO', 'Нет');
INSERT INTO `be_AdminLanguage` VALUES ('414', '2', 'PRODUCTS_CATEGORIES', 'Категории продукции');
INSERT INTO `be_AdminLanguage` VALUES ('415', '2', 'PRODUCTS', 'Продукты');
INSERT INTO `be_AdminLanguage` VALUES ('416', '2', 'PRODUCT_TYPE', 'Тип продукта');
INSERT INTO `be_AdminLanguage` VALUES ('417', '2', 'PRODUCTS_ATTRIBUTES', 'Атрибуты продуктов');
INSERT INTO `be_AdminLanguage` VALUES ('418', '2', 'RELATED_PRODUCTS', 'Связанные продукты');
INSERT INTO `be_AdminLanguage` VALUES ('419', '2', 'PRODUCT_NAME', 'Название продукта');
INSERT INTO `be_AdminLanguage` VALUES ('420', '2', 'TO', 'До');
INSERT INTO `be_AdminLanguage` VALUES ('421', '2', 'SELECT_VARIATION', 'Выберите атрибут');
INSERT INTO `be_AdminLanguage` VALUES ('422', '2', 'SELECT_VARIATION_DESCRIPTION', '');
INSERT INTO `be_AdminLanguage` VALUES ('423', '2', 'SELECT_VARIATION_ADDITION_TYPE', '--- Выберите вариант добавления атрибута продукта ---');
INSERT INTO `be_AdminLanguage` VALUES ('424', '2', 'LM_APPLICATIONS', 'Заявки на участие');
INSERT INTO `be_AdminLanguage` VALUES ('426', '2', 'LM_QUESTIONS_ANKET', 'Анкетирование');
INSERT INTO `be_AdminLanguage` VALUES ('427', '1', 'LM_QUESTIONS_ANKET', 'Питання анкет');
INSERT INTO `be_AdminLanguage` VALUES ('428', '1', 'PRINT', 'Друк');
INSERT INTO `be_AdminLanguage` VALUES ('429', '2', 'PRINT', 'Печать');
INSERT INTO `be_AdminLanguage` VALUES ('430', '1', 'BACK_TO_LIST', 'До списку');
INSERT INTO `be_AdminLanguage` VALUES ('431', '2', 'BACK_TO_LIST', 'К списку');
INSERT INTO `be_AdminLanguage` VALUES ('432', '1', 'CLOSE', 'Закрити');
INSERT INTO `be_AdminLanguage` VALUES ('433', '2', 'CLOSE', 'Закрыть');
INSERT INTO `be_AdminLanguage` VALUES ('434', '1', 'LM_CONTEST_QUESTIONS', 'Конкурс питань');
INSERT INTO `be_AdminLanguage` VALUES ('435', '2', 'LM_CONTEST_QUESTIONS', 'Конкус вопросов');
INSERT INTO `be_AdminLanguage` VALUES ('436', '1', 'LM_WEBTEXT', 'Статичні тексти');
INSERT INTO `be_AdminLanguage` VALUES ('437', '2', 'LM_WEBTEXT', 'Статические тексты');
INSERT INTO `be_AdminLanguage` VALUES ('438', '1', 'LM_WEBINARS', 'Вебінари');
INSERT INTO `be_AdminLanguage` VALUES ('439', '2', 'LM_WEBINARS', 'Вебинары');
INSERT INTO `be_AdminLanguage` VALUES ('440', '1', 'MM_WEBINARS', 'Вебінари');
INSERT INTO `be_AdminLanguage` VALUES ('441', '2', 'MM_WEBINARS', 'Вебинары');
INSERT INTO `be_AdminLanguage` VALUES ('442', '1', 'WEBINARS_CATALOG', 'Каталог вебінарів');
INSERT INTO `be_AdminLanguage` VALUES ('443', '2', 'WEBINARS_CATALOG', 'Каталог вебинаров');
INSERT INTO `be_AdminLanguage` VALUES ('444', '2', 'COUNTRY', 'Страна');
INSERT INTO `be_AdminLanguage` VALUES ('445', '2', 'REGION', 'Регион');
INSERT INTO `be_AdminLanguage` VALUES ('446', '2', 'CITY', 'Город');
INSERT INTO `be_AdminLanguage` VALUES ('447', '2', 'STREET', 'Улица');
INSERT INTO `be_AdminLanguage` VALUES ('448', '2', 'HOUSE_NUMBER', 'Номер дома');
INSERT INTO `be_AdminLanguage` VALUES ('449', '2', 'FLAT_NUMBER', 'Номер крвартиры');
INSERT INTO `be_AdminLanguage` VALUES ('450', '2', 'NAME', 'Имя');
INSERT INTO `be_AdminLanguage` VALUES ('451', '2', 'SURNAME', 'Фамилия');
INSERT INTO `be_AdminLanguage` VALUES ('452', '2', 'EMAIL', 'Email');
INSERT INTO `be_AdminLanguage` VALUES ('453', '2', 'PHONE_NUMBER', 'Номер телефона');
INSERT INTO `be_AdminLanguage` VALUES ('454', '2', 'PATRONYMIC', 'Отчество');
INSERT INTO `be_AdminLanguage` VALUES ('455', '2', 'BIRTHDATE', 'Дата рождения');
INSERT INTO `be_AdminLanguage` VALUES ('457', '2', 'UNIVERCITY', 'В.У.З');
INSERT INTO `be_AdminLanguage` VALUES ('459', '2', 'SCHOOL', 'Школа');
INSERT INTO `be_AdminLanguage` VALUES ('460', '2', 'INTERESTS', 'Увлечения');
INSERT INTO `be_AdminLanguage` VALUES ('462', '1', 'REGION', 'Регион');
INSERT INTO `be_AdminLanguage` VALUES ('463', '1', 'CITY', 'Город');
INSERT INTO `be_AdminLanguage` VALUES ('464', '1', 'STREET', 'Улица');
INSERT INTO `be_AdminLanguage` VALUES ('465', '1', 'HOUSE_NUMBER', 'Номер дома');
INSERT INTO `be_AdminLanguage` VALUES ('466', '1', 'FLAT_NUMBER', 'Номер крвартиры');
INSERT INTO `be_AdminLanguage` VALUES ('467', '1', 'NAME', 'Имя');
INSERT INTO `be_AdminLanguage` VALUES ('468', '1', 'SURNAME', 'Фамилия');
INSERT INTO `be_AdminLanguage` VALUES ('469', '1', 'EMAIL', 'Email');
INSERT INTO `be_AdminLanguage` VALUES ('470', '1', 'PHONE_NUMBER', 'Номер телефона');
INSERT INTO `be_AdminLanguage` VALUES ('471', '1', 'PATRONYMIC', 'Отчество');
INSERT INTO `be_AdminLanguage` VALUES ('472', '1', 'BIRTHDATE', 'Дата рождения');
INSERT INTO `be_AdminLanguage` VALUES ('473', '1', 'COURSE_NUMBER', 'Курс');
INSERT INTO `be_AdminLanguage` VALUES ('474', '1', 'UNIVERCITY', 'В.У.З');
INSERT INTO `be_AdminLanguage` VALUES ('475', '1', 'CLASS_NUMBER', 'Номер класса');
INSERT INTO `be_AdminLanguage` VALUES ('476', '1', 'SCHOOL', 'Школа');
INSERT INTO `be_AdminLanguage` VALUES ('477', '1', 'INTERESTS', 'Увлечения');
INSERT INTO `be_AdminLanguage` VALUES ('478', '1', 'COUNTRY', 'Страна');
INSERT INTO `be_AdminLanguage` VALUES ('479', '1', 'REGION', 'Регион');
INSERT INTO `be_AdminLanguage` VALUES ('480', '1', 'CITY', 'Город');
INSERT INTO `be_AdminLanguage` VALUES ('481', '1', 'STREET', 'Улица');
INSERT INTO `be_AdminLanguage` VALUES ('482', '1', 'HOUSE_NUMBER', 'Номер дома');
INSERT INTO `be_AdminLanguage` VALUES ('483', '1', 'FLAT_NUMBER', 'Номер крвартиры');
INSERT INTO `be_AdminLanguage` VALUES ('484', '1', 'NAME', 'Имя');
INSERT INTO `be_AdminLanguage` VALUES ('485', '1', 'SURNAME', 'Фамилия');
INSERT INTO `be_AdminLanguage` VALUES ('486', '1', 'EMAIL', 'Email');
INSERT INTO `be_AdminLanguage` VALUES ('487', '1', 'PHONE_NUMBER', 'Номер телефона');
INSERT INTO `be_AdminLanguage` VALUES ('488', '1', 'PATRONYMIC', 'Отчество');
INSERT INTO `be_AdminLanguage` VALUES ('489', '1', 'BIRTHDATE', 'Дата рождения');
INSERT INTO `be_AdminLanguage` VALUES ('490', '1', 'COURSE_NUMBER', 'Курс');
INSERT INTO `be_AdminLanguage` VALUES ('491', '1', 'UNIVERCITY', 'В.У.З');
INSERT INTO `be_AdminLanguage` VALUES ('492', '1', 'CLASS_NUMBER', 'Номер класса');
INSERT INTO `be_AdminLanguage` VALUES ('493', '1', 'SCHOOL', 'Школа');
INSERT INTO `be_AdminLanguage` VALUES ('519', '1', 'LOAD_PHOTOGALLERY', 'Завантажити галерею');
INSERT INTO `be_AdminLanguage` VALUES ('520', '2', 'LOAD_PHOTOGALLERY', 'Загрузить галерею');
INSERT INTO `be_AdminLanguage` VALUES ('521', '1', 'LM_COMMENTS', 'Коментарі');
INSERT INTO `be_AdminLanguage` VALUES ('522', '1', 'GOTOPAGE', 'На сторінку');
INSERT INTO `be_AdminLanguage` VALUES ('523', '1', 'UPDATE', 'Обновити');
INSERT INTO `be_AdminLanguage` VALUES ('524', '1', 'APPROVE', 'Одобрити');
INSERT INTO `be_AdminLanguage` VALUES ('525', '1', 'THEME', 'Тема');
INSERT INTO `be_AdminLanguage` VALUES ('526', '1', 'ADDED', 'Додано');
INSERT INTO `be_AdminLanguage` VALUES ('527', '1', 'PAGENOTEXISTS', 'Сторінка не існує');
INSERT INTO `be_AdminLanguage` VALUES ('528', '1', 'STRUCTURE', 'Структура');
INSERT INTO `be_AdminLanguage` VALUES ('529', '1', 'TEAMS', 'Команди');
INSERT INTO `be_AdminLanguage` VALUES ('530', '1', 'PLAYERS', 'Гравці');
INSERT INTO `be_AdminLanguage` VALUES ('531', '1', 'CALENDAR', 'Календар');
INSERT INTO `be_AdminLanguage` VALUES ('532', '1', 'TOURNAMETS', 'Турніри');
INSERT INTO `be_AdminLanguage` VALUES ('533', '1', 'ETAPS', 'Етапи');
INSERT INTO `be_AdminLanguage` VALUES ('534', '1', 'GROUPS', 'Групи');
INSERT INTO `be_AdminLanguage` VALUES ('535', '1', 'CONTEST_MEMBERS', 'Учасники груп');
INSERT INTO `be_AdminLanguage` VALUES ('536', '1', 'SEASON_TOURN', 'Турніри сезону');
INSERT INTO `be_AdminLanguage` VALUES ('537', '1', 'LM_REDACTORS', 'Редактори');
INSERT INTO `be_AdminLanguage` VALUES ('538', '1', 'REFEREES', 'Судді');
INSERT INTO `be_AdminLanguage` VALUES ('539', '1', 'SELECT_TOURNAMENT', 'Виберіть турнір');
INSERT INTO `be_AdminLanguage` VALUES ('540', '2', 'SELECT_TOURNAMENT', 'Выберите турнир');
INSERT INTO `be_AdminLanguage` VALUES ('541', '1', 'SEASONS', 'Сезони');
INSERT INTO `be_AdminLanguage` VALUES ('542', '2', 'SEASONS', 'Сезоны');
INSERT INTO `be_AdminLanguage` VALUES ('543', '1', 'ETAPS', 'Етапи');
INSERT INTO `be_AdminLanguage` VALUES ('544', '2', 'ETAPS', 'Этапы');
INSERT INTO `be_AdminLanguage` VALUES ('545', '1', 'VIEW_GAMES', 'Переглянути ігри');
INSERT INTO `be_AdminLanguage` VALUES ('546', '2', 'VIEW_GAMES', 'Просмотреть игры');
INSERT INTO `be_AdminLanguage` VALUES ('547', '1', 'GENERATE_GAMES', 'Згенерувати ігри');
INSERT INTO `be_AdminLanguage` VALUES ('548', '2', 'GENERATE_GAMES', 'Сгенерировать игры');
INSERT INTO `be_AdminLanguage` VALUES ('549', '1', 'GAMES', 'Ігри');
INSERT INTO `be_AdminLanguage` VALUES ('550', '2', 'GAMES', 'Игры');
INSERT INTO `be_AdminLanguage` VALUES ('551', '1', 'POPUP_TEXT', 'Якщо в базі вже існують ігри цієї групи, вони будуть замінені на згенеровані.');
INSERT INTO `be_AdminLanguage` VALUES ('552', '2', 'POPUP_TEXT', 'Если в базе уже существуют игры этой группы, они будут заменены на сгенерованные.');
INSERT INTO `be_AdminLanguage` VALUES ('553', '1', 'IMPORTSTATISTICS', 'Імпорт статистики');
INSERT INTO `be_AdminLanguage` VALUES ('554', '2', 'IMPORTSTATISTICS', 'Импорт статистики');
INSERT INTO `be_AdminLanguage` VALUES ('555', '1', 'IMPORT', 'Імпорт');
INSERT INTO `be_AdminLanguage` VALUES ('556', '2', 'IMPORT', 'Импорт');
INSERT INTO `be_AdminLanguage` VALUES ('557', '1', 'TEAM', 'Команда');
INSERT INTO `be_AdminLanguage` VALUES ('558', '2', 'TEAM', 'Команда');
INSERT INTO `be_AdminLanguage` VALUES ('560', '1', 'PUTSTATISTICS', 'Введення статистики');
INSERT INTO `be_AdminLanguage` VALUES ('561', '2', 'PUTSTATISTICS', 'Ввод статистики');
INSERT INTO `be_AdminLanguage` VALUES ('562', '1', 'NAME', 'Назва');
INSERT INTO `be_AdminLanguage` VALUES ('563', '2', 'NAME', 'Название');
INSERT INTO `be_AdminLanguage` VALUES ('564', '1', 'ROUNDS', 'Кола');
INSERT INTO `be_AdminLanguage` VALUES ('565', '2', 'ROUNDS', 'Круги');
INSERT INTO `be_AdminLanguage` VALUES ('566', '1', 'TYPE', 'Тип');
INSERT INTO `be_AdminLanguage` VALUES ('567', '2', 'TYPE', 'Тип');
INSERT INTO `be_AdminLanguage` VALUES ('568', '1', 'ORDER', 'Порядок');
INSERT INTO `be_AdminLanguage` VALUES ('569', '2', 'ORDER', 'Порядок');
INSERT INTO `be_AdminLanguage` VALUES ('570', '1', 'CHOOSE_GROUP', 'Вибіріть групу');
INSERT INTO `be_AdminLanguage` VALUES ('571', '2', 'CHOOSE_GROUP', 'Выберите группу');
INSERT INTO `be_AdminLanguage` VALUES ('572', '1', 'GROUP', 'Група');
INSERT INTO `be_AdminLanguage` VALUES ('573', '2', 'GROUP', 'Группа');
INSERT INTO `be_AdminLanguage` VALUES ('574', '1', 'PLACE', 'Місце');
INSERT INTO `be_AdminLanguage` VALUES ('575', '2', 'PLACE', 'Место');
INSERT INTO `be_AdminLanguage` VALUES ('576', '1', 'GENERATE', 'Згенерувати');
INSERT INTO `be_AdminLanguage` VALUES ('577', '2', 'GENERATE', 'Згенерировать');
INSERT INTO `be_AdminLanguage` VALUES ('578', '1', 'NO_GAMES_TEXT', 'В даній групі немає ігор');
INSERT INTO `be_AdminLanguage` VALUES ('579', '2', 'NO_GAMES_TEXT', 'В данной группе нет игор');
INSERT INTO `be_AdminLanguage` VALUES ('580', '1', 'BY_RULES', 'за правилами');
INSERT INTO `be_AdminLanguage` VALUES ('581', '2', 'BY_RULES', 'по правилам');
INSERT INTO `be_AdminLanguage` VALUES ('582', '1', 'BY_COUNT', 'за кількістю');
INSERT INTO `be_AdminLanguage` VALUES ('583', '2', 'BY_COUNT', 'по количеству');
INSERT INTO `be_AdminLanguage` VALUES ('584', '1', 'COUNT_GAMES', 'Кількість ігор');
INSERT INTO `be_AdminLanguage` VALUES ('585', '2', 'COUNT_GAMES', 'Количество игр');
INSERT INTO `be_AdminLanguage` VALUES ('586', '1', 'WINNER', 'переможець');
INSERT INTO `be_AdminLanguage` VALUES ('587', '2', 'WINNER', 'победитель');
INSERT INTO `be_AdminLanguage` VALUES ('588', '1', 'LOOSER', 'переможений');
INSERT INTO `be_AdminLanguage` VALUES ('589', '2', 'LOOSER', 'проигравший');
INSERT INTO `be_AdminLanguage` VALUES ('590', '1', 'PLACE_SM', 'місце');
INSERT INTO `be_AdminLanguage` VALUES ('591', '2', 'PLACE_SM', 'место');
INSERT INTO `be_AdminLanguage` VALUES ('592', '1', 'LM_MESS', 'Повідомлення');
INSERT INTO `be_AdminLanguage` VALUES ('593', '1', 'LANGUAGE_LISTS', 'Доступні мови');
INSERT INTO `be_AdminLanguage` VALUES ('594', '1', 'PAGE_CODE_ALERT_TEXT', 'Ви намагаэтеся змінити код сторінки, який вже міг бути проіндексований пошуковими системами. В такому випадку, зміна коду призведе до отримання користувачем 404-ї сторінки');
INSERT INTO `be_AdminLanguage` VALUES ('595', '1', 'ATTENTION', 'Увага!');
INSERT INTO `be_AdminLanguage` VALUES ('596', '1', 'LANGUAGE_LISTS', 'Доступні мови');
INSERT INTO `be_AdminLanguage` VALUES ('597', '1', 'COPY_LANGUAGE_CONTENT', 'Копіювати контент');
INSERT INTO `be_AdminLanguage` VALUES ('598', '1', 'LM_SITE_SETTINGS', 'Налаштування сайтів');
INSERT INTO `be_AdminLanguage` VALUES ('600', '1', 'CURRENT_WEBSITE', 'Поточний сайт:');
INSERT INTO `be_AdminLanguage` VALUES ('601', '1', 'LANGUAGE_LISTS', 'Доступні мови');
INSERT INTO `be_AdminLanguage` VALUES ('602', '2', 'LANGUAGE_LISTS', 'Доступные языки');
INSERT INTO `be_AdminLanguage` VALUES ('603', '1', 'PAGE_CODE_ALERT_TEXT', 'Ви намагаэтеся змінити код сторінки, який вже міг бути проіндексований пошуковими системами. В такому випадку, зміна коду призведе до отримання користувачем 404-ї сторінки');
INSERT INTO `be_AdminLanguage` VALUES ('604', '2', 'PAGE_CODE_ALERT_TEXT', 'Вы пытаетесь изменить код страницы, который мог уже быть проиндексирован поисковыми системами. В таком случае, изменение кода приведет к получению пользователем 404-й стораницы');
INSERT INTO `be_AdminLanguage` VALUES ('605', '1', 'ATTENTION', 'Увага!');
INSERT INTO `be_AdminLanguage` VALUES ('606', '2', 'ATTENTION', 'Внимание!');
INSERT INTO `be_AdminLanguage` VALUES ('607', '1', 'RELATIONS', 'Звязки');
INSERT INTO `be_AdminLanguage` VALUES ('608', '2', 'RELATIONS', 'Связи');
INSERT INTO `be_AdminLanguage` VALUES ('609', '1', 'RELATED_CONTENT', 'Повязаний контент на інших мовах');
INSERT INTO `be_AdminLanguage` VALUES ('610', '2', 'RELATED_CONTENT', 'Связанный контент на других языках');
INSERT INTO `be_AdminLanguage` VALUES ('611', '1', 'ADD_RELATED_CONTENT', 'Створити контент');
INSERT INTO `be_AdminLanguage` VALUES ('612', '2', 'ADD_RELATED_CONTENT', 'Создать контент');
INSERT INTO `be_AdminLanguage` VALUES ('614', '2', 'COPY_LANGUAGE_CONTENT', 'Копирование контента');
INSERT INTO `be_AdminLanguage` VALUES ('615', '1', 'SEARCH_RELATED_CONTENT', 'Знайти контент');
INSERT INTO `be_AdminLanguage` VALUES ('616', '2', 'SEARCH_RELATED_CONTENT', 'Искать контент');
INSERT INTO `be_AdminLanguage` VALUES ('617', '1', 'LANG', 'Мова');
INSERT INTO `be_AdminLanguage` VALUES ('618', '2', 'LANG', 'Язык');
INSERT INTO `be_AdminLanguage` VALUES ('619', '1', 'FOUND_PAGE_NOT_MERGABLE', 'Обрана сторінка вже має звязок із контентом на мові, яку Ви обрали. ');
INSERT INTO `be_AdminLanguage` VALUES ('620', '2', 'FOUND_PAGE_NOT_MERGABLE', 'Выбранная страница уже имеет связь с контеном на языке, который Вы выбрали.');
INSERT INTO `be_AdminLanguage` VALUES ('621', '1', 'PAGES_ARE_NOT_MERGABLE', 'Обрана сторінка не може бути додана до звязку. Сторінка, яку Ви редагуєете вже має звязок із сторінкою на обраній мові.');
INSERT INTO `be_AdminLanguage` VALUES ('622', '2', 'PAGES_ARE_NOT_MERGABLE', 'Выбранная страница не может быть добавлена к связи. СТраница, которвую Вы редактируете уже имеет связь с страницей на выбранном языке.');
INSERT INTO `be_AdminLanguage` VALUES ('623', '1', 'SAVE_EDITED_CONTENT', 'Зберегти зміни на поточній сторінці і перейти до редагування повязаної сторінки?');
INSERT INTO `be_AdminLanguage` VALUES ('624', '2', 'SAVE_EDITED_CONTENT', 'Сохранить изменения на текущей странице и перейти к редактированию связанной страницы?');
INSERT INTO `be_AdminLanguage` VALUES ('625', '1', 'DELETE_PAGE_RELATION', 'Ви дійсно бажаєте видалити звязок з цим контентом?');
INSERT INTO `be_AdminLanguage` VALUES ('626', '2', 'DELETE_PAGE_RELATION', 'Удалить связь с этим контентом?');
INSERT INTO `be_AdminLanguage` VALUES ('627', '1', 'COPY_CONTENT_TO_NEXT_LANGS', 'Створити повязаний контент на наступних мовах:');
INSERT INTO `be_AdminLanguage` VALUES ('628', '2', 'COPY_CONTENT_TO_NEXT_LANGS', 'Создать связанный контент на следующих языках:');
INSERT INTO `be_AdminLanguage` VALUES ('629', '1', 'NEXT_LANG_CONTENT_ADD', 'Увага!<br/>Збережені дані будуть використані при створенні повязаного контенту для наступної мови.');
INSERT INTO `be_AdminLanguage` VALUES ('630', '2', 'NEXT_LANG_CONTENT_ADD', 'Внимание!<br/> Сохраненные данные будут использованы при создании связанного контента для следующего языка.');
INSERT INTO `be_AdminLanguage` VALUES ('631', '3', 'COPY_LANGUAGE_CONTENT', 'Copy content');
INSERT INTO `be_AdminLanguage` VALUES ('632', '1', 'FILEMANAGER_9', 'Завантажити з обробкою');
INSERT INTO `be_AdminLanguage` VALUES ('633', '2', 'FILEMANAGER_9', 'Загрузить с обработкой');
INSERT INTO `be_AdminLanguage` VALUES ('634', '3', 'FILEMANAGER_9', 'Upload with processing');
INSERT INTO `be_AdminLanguage` VALUES ('635', '1', 'TASKS_FORM_TITLE', 'Процеси');
INSERT INTO `be_AdminLanguage` VALUES ('636', '1', 'TASKS_FORM_RESULT_TITLE', 'Статус процеса');
INSERT INTO `be_AdminLanguage` VALUES ('637', '1', 'FILEMANAGER_10', 'Налаштування розмірів');
INSERT INTO `be_AdminLanguage` VALUES ('638', '2', 'FILEMANAGER_10', 'Настройка размеров');
INSERT INTO `be_AdminLanguage` VALUES ('639', '1', 'COPY_SITE_SETTINGS', 'Копіювати сайт');
INSERT INTO `be_AdminLanguage` VALUES ('640', '2', 'COPY_SITE_SETTINGS', 'Копировать сайт');
INSERT INTO `be_AdminLanguage` VALUES ('641', '1', 'FILEMANAGER_11', 'Логотип');
INSERT INTO `be_AdminLanguage` VALUES ('642', '2', 'FILEMANAGER_11', 'Логотип');
INSERT INTO `be_AdminLanguage` VALUES ('643', '3', 'FILEMANAGER_11', 'Logo');
INSERT INTO `be_AdminLanguage` VALUES ('644', '1', 'FILEMANAGER_12', 'Обробка зображень');
INSERT INTO `be_AdminLanguage` VALUES ('645', '2', 'FILEMANAGER_12', 'Обработка изображений');
INSERT INTO `be_AdminLanguage` VALUES ('646', '3', 'FILEMANAGER_12', 'Image processing');
INSERT INTO `be_AdminLanguage` VALUES ('647', '1', 'FILEMANAGER_13', 'Текстовий опис');
INSERT INTO `be_AdminLanguage` VALUES ('648', '2', 'FILEMANAGER_13', 'Текстовое описание');
INSERT INTO `be_AdminLanguage` VALUES ('649', '3', 'FILEMANAGER_13', 'Description');
INSERT INTO `be_AdminLanguage` VALUES ('650', '1', 'FILEMANAGER_14', 'URL автора:');
INSERT INTO `be_AdminLanguage` VALUES ('651', '2', 'FILEMANAGER_14', 'URL автора:');
INSERT INTO `be_AdminLanguage` VALUES ('652', '3', 'FILEMANAGER_14', 'Author`s URL:');
INSERT INTO `be_AdminLanguage` VALUES ('653', '1', 'FILEMANAGER_15', 'Назва об`єкту:');
INSERT INTO `be_AdminLanguage` VALUES ('654', '2', 'FILEMANAGER_15', 'Название объекта:');
INSERT INTO `be_AdminLanguage` VALUES ('655', '3', 'FILEMANAGER_15', 'Name of object:');
INSERT INTO `be_AdminLanguage` VALUES ('656', '1', 'FILEMANAGER_16', 'Назва роботи:');
INSERT INTO `be_AdminLanguage` VALUES ('657', '2', 'FILEMANAGER_16', 'Название работы:');
INSERT INTO `be_AdminLanguage` VALUES ('658', '3', 'FILEMANAGER_16', 'Name of operation:');
INSERT INTO `be_AdminLanguage` VALUES ('659', '1', 'FILEMANAGER_17', 'Автор:');
INSERT INTO `be_AdminLanguage` VALUES ('660', '2', 'FILEMANAGER_17', 'Автор:');
INSERT INTO `be_AdminLanguage` VALUES ('661', '3', 'FILEMANAGER_17', 'Author:');
INSERT INTO `be_AdminLanguage` VALUES ('662', '1', 'FILEMANAGER_18', 'Мета дані');
INSERT INTO `be_AdminLanguage` VALUES ('663', '2', 'FILEMANAGER_18', 'Мета данные');
INSERT INTO `be_AdminLanguage` VALUES ('664', '3', 'FILEMANAGER_18', 'Meta data');
INSERT INTO `be_AdminLanguage` VALUES ('665', '3', 'FILEMANAGER_10', 'Sizes settings');
INSERT INTO `be_AdminLanguage` VALUES ('666', '1', 'FILEMANAGER_19', 'Доступні розміри');
INSERT INTO `be_AdminLanguage` VALUES ('667', '2', 'FILEMANAGER_19', 'Доступные размеры');
INSERT INTO `be_AdminLanguage` VALUES ('668', '3', 'FILEMANAGER_19', 'Available sizes');
INSERT INTO `be_AdminLanguage` VALUES ('669', '1', 'FILEMANAGER_20', 'Накласти логотип');
INSERT INTO `be_AdminLanguage` VALUES ('670', '2', 'FILEMANAGER_20', 'Наложить логотип');
INSERT INTO `be_AdminLanguage` VALUES ('671', '3', 'FILEMANAGER_20', 'Apply logo');
INSERT INTO `be_AdminLanguage` VALUES ('672', '1', 'FILEMANAGER_21', 'Зберегти пропорції');
INSERT INTO `be_AdminLanguage` VALUES ('673', '2', 'FILEMANAGER_21', 'Сохранить пропорции');
INSERT INTO `be_AdminLanguage` VALUES ('674', '3', 'FILEMANAGER_21', 'Maintain aspect ratio');
INSERT INTO `be_AdminLanguage` VALUES ('675', '1', 'FILEMANAGER_22', 'Додати розмір');
INSERT INTO `be_AdminLanguage` VALUES ('676', '2', 'FILEMANAGER_22', 'Добавить размер');
INSERT INTO `be_AdminLanguage` VALUES ('677', '3', 'FILEMANAGER_22', 'Add size');
INSERT INTO `be_AdminLanguage` VALUES ('678', '1', 'FILEMANAGER_23', 'Ім`я файлу:');
INSERT INTO `be_AdminLanguage` VALUES ('679', '2', 'FILEMANAGER_23', 'Имя файла:');
INSERT INTO `be_AdminLanguage` VALUES ('680', '3', 'FILEMANAGER_23', 'File name:');
INSERT INTO `be_AdminLanguage` VALUES ('681', '1', 'FILEMANAGER_24', 'id_розмір_');
INSERT INTO `be_AdminLanguage` VALUES ('682', '2', 'FILEMANAGER_24', 'id_размер_');
INSERT INTO `be_AdminLanguage` VALUES ('683', '3', 'FILEMANAGER_24', 'id_size_');
INSERT INTO `be_AdminLanguage` VALUES ('687', '1', 'ACCEPT', 'Застосувати');
INSERT INTO `be_AdminLanguage` VALUES ('688', '2', 'ACCEPT', 'Примениить');
INSERT INTO `be_AdminLanguage` VALUES ('689', '3', 'ACCEPT', 'Accept');
INSERT INTO `be_AdminLanguage` VALUES ('690', '3', 'OBJECT_HAS_THIS_IMAGE', 'Image with same id is related to this object');
INSERT INTO `be_AdminLanguage` VALUES ('691', '2', 'OBJECT_HAS_THIS_IMAGE', 'Изображение с таким id уже привязано к этому объекту');
INSERT INTO `be_AdminLanguage` VALUES ('692', '1', 'OBJECT_HAS_THIS_IMAGE', 'Зображення з таким id вже привязане до цього обєкту');
INSERT INTO `be_AdminLanguage` VALUES ('693', '1', 'COPY_ITEM_FINISHED_FAILD', 'Копіювання відбулося з помилкою');
INSERT INTO `be_AdminLanguage` VALUES ('694', '1', 'COPY_ITEM_FINISHED_SUCCESS', 'Дані були успішно зкопійовані');
INSERT INTO `be_AdminLanguage` VALUES ('695', '1', 'COPY_ON_SELECTED_SITES', 'Копіювати на обрані сайти');
INSERT INTO `be_AdminLanguage` VALUES ('696', '1', 'COPY_ON_ALL_SITES', 'Копіювати на всі сайти');
INSERT INTO `be_AdminLanguage` VALUES ('697', '2', 'COPY_ITEM', 'Копировать');
INSERT INTO `be_AdminLanguage` VALUES ('698', '1', 'COPY_ITEM', 'Копіювати');
INSERT INTO `be_AdminLanguage` VALUES ('699', '1', 'PRELIMINARY_SAWE_FIELDS_REQUIRED', 'Заповніть всі обов\'язкові поля');
INSERT INTO `be_AdminLanguage` VALUES ('857', '3', 'LM_CLEAR_CACHE', 'Clear the cache');
INSERT INTO `be_AdminLanguage` VALUES ('858', '3', 'MM_USERSMANAGE', 'User management');
INSERT INTO `be_AdminLanguage` VALUES ('859', '3', 'LM_USERS', 'Users');
INSERT INTO `be_AdminLanguage` VALUES ('860', '3', 'AD_SEARCH', 'Search ads');
INSERT INTO `be_AdminLanguage` VALUES ('861', '3', 'LM_AD', 'Ads');
INSERT INTO `be_AdminLanguage` VALUES ('862', '3', 'LM_ADD_PRODUCT', 'Add');
INSERT INTO `be_AdminLanguage` VALUES ('863', '3', 'LM_PRODUCT_MANAGER', 'Products');
INSERT INTO `be_AdminLanguage` VALUES ('864', '3', 'MM_ORDER_MANAGER', 'Order');
INSERT INTO `be_AdminLanguage` VALUES ('865', '3', 'LM_ORDER_MANAGER', 'Order');
INSERT INTO `be_AdminLanguage` VALUES ('866', '3', 'FROM', 'From');
INSERT INTO `be_AdminLanguage` VALUES ('867', '3', 'TO', 'To');
INSERT INTO `be_AdminLanguage` VALUES ('868', '3', 'PRODUCTS_CATEGORIES', 'Product categories');
INSERT INTO `be_AdminLanguage` VALUES ('869', '3', 'ADD_MODULE', 'Add module');
INSERT INTO `be_AdminLanguage` VALUES ('870', '3', 'PRODUCTS', 'Products');
INSERT INTO `be_AdminLanguage` VALUES ('871', '3', 'ADVERTISEMENTS', 'Ads');
INSERT INTO `be_AdminLanguage` VALUES ('872', '3', 'ADD_ITEM', 'Add item');
INSERT INTO `be_AdminLanguage` VALUES ('873', '3', 'ADD_CATEGORY', 'Add category');
INSERT INTO `be_AdminLanguage` VALUES ('874', '3', 'ADD_SUBCATEGORY', 'Add a subcategory');
INSERT INTO `be_AdminLanguage` VALUES ('875', '3', 'PRODUCT_TYPE', 'Product type');
INSERT INTO `be_AdminLanguage` VALUES ('876', '3', 'COUNT_AVALIBLE', 'The number of available');
INSERT INTO `be_AdminLanguage` VALUES ('877', '3', 'COUNT_ORDERED', 'The number of ordered');
INSERT INTO `be_AdminLanguage` VALUES ('878', '3', 'VARIATION_TYPE', 'Type variations');
INSERT INTO `be_AdminLanguage` VALUES ('879', '3', 'SELECT_VARIATION', 'Select attribute');
INSERT INTO `be_AdminLanguage` VALUES ('880', '3', 'NEW_VARIATION_NAME', 'The name of the new attribute');
INSERT INTO `be_AdminLanguage` VALUES ('881', '3', 'NEW_VARIATION_ITEM', 'The recording of the new attribute');
INSERT INTO `be_AdminLanguage` VALUES ('882', '3', 'ADD_TO_LIST', 'Add to the list');
INSERT INTO `be_AdminLanguage` VALUES ('883', '3', 'NEW_VARIATION_ITEMS', 'Attribute entry');
INSERT INTO `be_AdminLanguage` VALUES ('884', '3', 'ADD_PRODUCT_ATTRIBUTE', 'Add an attribute of the product...');
INSERT INTO `be_AdminLanguage` VALUES ('885', '3', 'ADD_ATTRIBUTE_DESCRIPTION', 'Add a list of attributes to create a set of products. The maximum number of variations attributes - 3');
INSERT INTO `be_AdminLanguage` VALUES ('886', '3', 'SELECT_VARIATION_DESCRIPTION', 'Select from the drop-down list of existing product attribute. After loading options attribute, select the desired options and click &quot;Save&quot;. If the required attribute is not in the list, and you must add one - click &quot;New attribute&quot; in the drop down list.');
INSERT INTO `be_AdminLanguage` VALUES ('887', '3', 'ADD_VARIATION_ITEM_DESCRIPTION', 'Enter &quot;Record new attribute&quot; kind of product attribute. After that, click &quot;Add&quot;, a record is added to the list of &quot;attribute entry&quot;');
INSERT INTO `be_AdminLanguage` VALUES ('888', '3', 'PRODUCTS_ATTRIBUTES', 'Product attributes');
INSERT INTO `be_AdminLanguage` VALUES ('889', '3', 'VARIATION_ADDITION_NEW', 'Adding a new attribute');
INSERT INTO `be_AdminLanguage` VALUES ('890', '3', 'VARIATION_ADDITION_EXIST', 'The choice of the existing attributes');
INSERT INTO `be_AdminLanguage` VALUES ('891', '3', 'SELECT_VARIATION_ADDITION_TYPE', '--- Select add атрубуту product ---');
INSERT INTO `be_AdminLanguage` VALUES ('892', '3', 'CURR_PRODUCT_ATTRIBUTES', 'The attributes of the current product');
INSERT INTO `be_AdminLanguage` VALUES ('893', '3', 'RELATED_PRODUCTS', 'Related products');
INSERT INTO `be_AdminLanguage` VALUES ('894', '3', 'PRODUCT_NAME', 'Product name');
INSERT INTO `be_AdminLanguage` VALUES ('895', '3', 'NO_ADDWORDS_FOUNDED', 'The word entered in the database is not found. Add it?');
INSERT INTO `be_AdminLanguage` VALUES ('896', '3', 'YES', 'So');
INSERT INTO `be_AdminLanguage` VALUES ('897', '3', 'NO', 'No');
INSERT INTO `be_AdminLanguage` VALUES ('898', '3', 'LM_QUESTIONS_ANKET', 'Questionnaires');
INSERT INTO `be_AdminLanguage` VALUES ('899', '3', 'PRINT', 'Print');
INSERT INTO `be_AdminLanguage` VALUES ('900', '3', 'BACK_TO_LIST', 'To the list');
INSERT INTO `be_AdminLanguage` VALUES ('901', '3', 'CLOSE', 'Close');
INSERT INTO `be_AdminLanguage` VALUES ('902', '3', 'LM_CONTEST_QUESTIONS', 'Competition issues');
INSERT INTO `be_AdminLanguage` VALUES ('903', '3', 'LM_WEBTEXT', 'Static texts');
INSERT INTO `be_AdminLanguage` VALUES ('904', '3', 'LM_WEBINARS', 'Webinars');
INSERT INTO `be_AdminLanguage` VALUES ('905', '3', 'MM_WEBINARS', 'Webinars');
INSERT INTO `be_AdminLanguage` VALUES ('906', '3', 'WEBINARS_CATALOG', 'Catalog of webinars');
INSERT INTO `be_AdminLanguage` VALUES ('907', '3', 'REGION', 'Region');
INSERT INTO `be_AdminLanguage` VALUES ('908', '3', 'CITY', 'Vegetable garden');
INSERT INTO `be_AdminLanguage` VALUES ('909', '3', 'STREET', 'Street');
INSERT INTO `be_AdminLanguage` VALUES ('910', '3', 'HOUSE_NUMBER', 'House number');
INSERT INTO `be_AdminLanguage` VALUES ('911', '3', 'FLAT_NUMBER', 'Room крвартиры');
INSERT INTO `be_AdminLanguage` VALUES ('912', '3', 'NAME', 'Name');
INSERT INTO `be_AdminLanguage` VALUES ('913', '3', 'SURNAME', 'Surname');
INSERT INTO `be_AdminLanguage` VALUES ('914', '3', 'EMAIL', 'Email');
INSERT INTO `be_AdminLanguage` VALUES ('915', '3', 'PHONE_NUMBER', 'Phone number');
INSERT INTO `be_AdminLanguage` VALUES ('916', '3', 'PATRONYMIC', 'Patronymic');
INSERT INTO `be_AdminLanguage` VALUES ('917', '3', 'BIRTHDATE', 'Date of birth');
INSERT INTO `be_AdminLanguage` VALUES ('918', '3', 'COURSE_NUMBER', 'Course');
INSERT INTO `be_AdminLanguage` VALUES ('919', '3', 'UNIVERCITY', 'В.У.З');
INSERT INTO `be_AdminLanguage` VALUES ('920', '3', 'CLASS_NUMBER', 'Room class');
INSERT INTO `be_AdminLanguage` VALUES ('921', '3', 'SCHOOL', 'School');
INSERT INTO `be_AdminLanguage` VALUES ('922', '3', 'INTERESTS', 'Hobbies');
INSERT INTO `be_AdminLanguage` VALUES ('923', '3', 'COUNTRY', 'Country');
INSERT INTO `be_AdminLanguage` VALUES ('924', '3', 'REGION', 'Region');
INSERT INTO `be_AdminLanguage` VALUES ('925', '3', 'CITY', 'Vegetable garden');
INSERT INTO `be_AdminLanguage` VALUES ('926', '3', 'STREET', 'Street');
INSERT INTO `be_AdminLanguage` VALUES ('927', '3', 'HOUSE_NUMBER', 'House number');
INSERT INTO `be_AdminLanguage` VALUES ('928', '3', 'FLAT_NUMBER', 'Room крвартиры');
INSERT INTO `be_AdminLanguage` VALUES ('929', '3', 'NAME', 'Name');
INSERT INTO `be_AdminLanguage` VALUES ('930', '3', 'SURNAME', 'Surname');
INSERT INTO `be_AdminLanguage` VALUES ('931', '3', 'EMAIL', 'Email');
INSERT INTO `be_AdminLanguage` VALUES ('932', '3', 'PHONE_NUMBER', 'Phone number');
INSERT INTO `be_AdminLanguage` VALUES ('933', '3', 'PATRONYMIC', 'Patronymic');
INSERT INTO `be_AdminLanguage` VALUES ('934', '3', 'BIRTHDATE', 'Date of birth');
INSERT INTO `be_AdminLanguage` VALUES ('935', '3', 'COURSE_NUMBER', 'Course');
INSERT INTO `be_AdminLanguage` VALUES ('936', '3', 'UNIVERCITY', 'В.У.З');
INSERT INTO `be_AdminLanguage` VALUES ('937', '3', 'CLASS_NUMBER', 'Room class');
INSERT INTO `be_AdminLanguage` VALUES ('938', '3', 'SCHOOL', 'School');
INSERT INTO `be_AdminLanguage` VALUES ('939', '3', 'LOAD_PHOTOGALLERY', 'Download gallery');
INSERT INTO `be_AdminLanguage` VALUES ('940', '3', 'LM_COMMENTS', 'Comments');
INSERT INTO `be_AdminLanguage` VALUES ('941', '3', 'GOTOPAGE', 'On the page');
INSERT INTO `be_AdminLanguage` VALUES ('942', '3', 'UPDATE', 'Update');
INSERT INTO `be_AdminLanguage` VALUES ('943', '3', 'APPROVE', 'Одобрити');
INSERT INTO `be_AdminLanguage` VALUES ('944', '3', 'THEME', 'Theme');
INSERT INTO `be_AdminLanguage` VALUES ('945', '3', 'ADDED', 'Added');
INSERT INTO `be_AdminLanguage` VALUES ('946', '3', 'PAGENOTEXISTS', 'The page does not exist');
INSERT INTO `be_AdminLanguage` VALUES ('947', '3', 'STRUCTURE', 'Structure');
INSERT INTO `be_AdminLanguage` VALUES ('948', '3', 'TEAMS', 'Team');
INSERT INTO `be_AdminLanguage` VALUES ('949', '3', 'PLAYERS', 'Players');
INSERT INTO `be_AdminLanguage` VALUES ('950', '3', 'CALENDAR', 'Calendar');
INSERT INTO `be_AdminLanguage` VALUES ('951', '3', 'TOURNAMETS', 'Tournaments');
INSERT INTO `be_AdminLanguage` VALUES ('952', '3', 'ETAPS', 'Stages');
INSERT INTO `be_AdminLanguage` VALUES ('953', '3', 'GROUPS', 'Group');
INSERT INTO `be_AdminLanguage` VALUES ('954', '3', 'CONTEST_MEMBERS', 'Team members');
INSERT INTO `be_AdminLanguage` VALUES ('955', '3', 'SEASON_TOURN', 'Tournaments of the season');
INSERT INTO `be_AdminLanguage` VALUES ('956', '3', 'LM_REDACTORS', 'Editors');
INSERT INTO `be_AdminLanguage` VALUES ('957', '3', 'REFEREES', 'Judge');
INSERT INTO `be_AdminLanguage` VALUES ('958', '3', 'SELECT_TOURNAMENT', 'Select the tournament');
INSERT INTO `be_AdminLanguage` VALUES ('959', '3', 'SEASONS', 'Seasons');
INSERT INTO `be_AdminLanguage` VALUES ('960', '3', 'ETAPS', 'Stages');
INSERT INTO `be_AdminLanguage` VALUES ('961', '3', 'VIEW_GAMES', 'Show games');
INSERT INTO `be_AdminLanguage` VALUES ('962', '3', 'GENERATE_GAMES', 'Generate games');
INSERT INTO `be_AdminLanguage` VALUES ('963', '3', 'GAMES', 'Games');
INSERT INTO `be_AdminLanguage` VALUES ('964', '3', 'POPUP_TEXT', 'If the database already exist game of this group, they will be replaced with generated.');
INSERT INTO `be_AdminLanguage` VALUES ('965', '3', 'IMPORTSTATISTICS', 'Import statistics');
INSERT INTO `be_AdminLanguage` VALUES ('966', '3', 'IMPORT', 'Import');
INSERT INTO `be_AdminLanguage` VALUES ('967', '3', 'TEAM', 'Team');
INSERT INTO `be_AdminLanguage` VALUES ('968', '3', 'PUTSTATISTICS', 'Introduction statistics');
INSERT INTO `be_AdminLanguage` VALUES ('969', '3', 'NAME', 'Name');
INSERT INTO `be_AdminLanguage` VALUES ('970', '3', 'ROUNDS', 'Circles');
INSERT INTO `be_AdminLanguage` VALUES ('971', '3', 'TYPE', 'Type');
INSERT INTO `be_AdminLanguage` VALUES ('972', '3', 'ORDER', 'Order');
INSERT INTO `be_AdminLanguage` VALUES ('973', '3', 'CHOOSE_GROUP', 'Вибіріть group');
INSERT INTO `be_AdminLanguage` VALUES ('974', '3', 'GROUP', 'Group');
INSERT INTO `be_AdminLanguage` VALUES ('975', '3', 'PLACE', 'Place');
INSERT INTO `be_AdminLanguage` VALUES ('976', '3', 'GENERATE', 'Generate');
INSERT INTO `be_AdminLanguage` VALUES ('977', '3', 'NO_GAMES_TEXT', 'In this group, no games');
INSERT INTO `be_AdminLanguage` VALUES ('978', '3', 'BY_RULES', 'according to the rules');
INSERT INTO `be_AdminLanguage` VALUES ('979', '3', 'BY_COUNT', 'by the number of');
INSERT INTO `be_AdminLanguage` VALUES ('980', '3', 'COUNT_GAMES', 'Number of games');
INSERT INTO `be_AdminLanguage` VALUES ('981', '3', 'WINNER', 'winner');
INSERT INTO `be_AdminLanguage` VALUES ('982', '3', 'LOOSER', 'defeated');
INSERT INTO `be_AdminLanguage` VALUES ('983', '3', 'PLACE_SM', 'place');
INSERT INTO `be_AdminLanguage` VALUES ('984', '3', 'LM_MESS', 'Message');
INSERT INTO `be_AdminLanguage` VALUES ('985', '3', 'LANGUAGE_LISTS', 'Available languages');
INSERT INTO `be_AdminLanguage` VALUES ('986', '3', 'PAGE_CODE_ALERT_TEXT', 'You намагаэтеся change the code page that could be indexed by search engines. In this case, the change of the code will result in a user-404-page');
INSERT INTO `be_AdminLanguage` VALUES ('987', '3', 'ATTENTION', 'Attention!');
INSERT INTO `be_AdminLanguage` VALUES ('988', '3', 'LANGUAGE_LISTS', 'Available languages');
INSERT INTO `be_AdminLanguage` VALUES ('989', '3', 'LM_SITE_SETTINGS', 'Configuring sites');
INSERT INTO `be_AdminLanguage` VALUES ('990', '3', 'CURRENT_WEBSITE', 'Current site:');
INSERT INTO `be_AdminLanguage` VALUES ('991', '3', 'LANGUAGE_LISTS', 'Available languages');
INSERT INTO `be_AdminLanguage` VALUES ('992', '3', 'PAGE_CODE_ALERT_TEXT', 'You намагаэтеся change the code page that could be indexed by search engines. In this case, the change of the code will result in a user-404-page');
INSERT INTO `be_AdminLanguage` VALUES ('993', '3', 'ATTENTION', 'Attention!');
INSERT INTO `be_AdminLanguage` VALUES ('994', '3', 'RELATIONS', 'Relations');
INSERT INTO `be_AdminLanguage` VALUES ('995', '3', 'RELATED_CONTENT', 'Associated content in other languages');
INSERT INTO `be_AdminLanguage` VALUES ('996', '3', 'ADD_RELATED_CONTENT', 'Create content');
INSERT INTO `be_AdminLanguage` VALUES ('997', '3', 'SEARCH_RELATED_CONTENT', 'Find content');
INSERT INTO `be_AdminLanguage` VALUES ('998', '3', 'LANG', 'Language');
INSERT INTO `be_AdminLanguage` VALUES ('999', '3', 'FOUND_PAGE_NOT_MERGABLE', 'The selected page already has a relationship with the content in the language You have chosen. ');
INSERT INTO `be_AdminLanguage` VALUES ('1000', '3', 'PAGES_ARE_NOT_MERGABLE', 'The selected page could not be added to the relation. The page You редагуєете already has a relationship with the page in the selected language.');
INSERT INTO `be_AdminLanguage` VALUES ('1001', '3', 'SAVE_EDITED_CONTENT', 'Save the changes on the current page and start editing the associated page?');
INSERT INTO `be_AdminLanguage` VALUES ('1002', '3', 'DELETE_PAGE_RELATION', 'You really want to delete the link with that content?');
INSERT INTO `be_AdminLanguage` VALUES ('1003', '3', 'COPY_CONTENT_TO_NEXT_LANGS', 'Create a linked content in the following languages:');
INSERT INTO `be_AdminLanguage` VALUES ('1004', '3', 'NEXT_LANG_CONTENT_ADD', 'Attention!<br/>Saved data will be used for creation of related content for the next language.');
INSERT INTO `be_AdminLanguage` VALUES ('1005', '3', 'TASKS_FORM_TITLE', 'Processes');
INSERT INTO `be_AdminLanguage` VALUES ('1006', '3', 'TASKS_FORM_RESULT_TITLE', 'Process status');
INSERT INTO `be_AdminLanguage` VALUES ('1007', '3', 'COPY_SITE_SETTINGS', 'Copy the website');
INSERT INTO `be_AdminLanguage` VALUES ('1008', '3', 'COPY_ITEM_FINISHED_FAILD', 'Copying with an error occurred');
INSERT INTO `be_AdminLanguage` VALUES ('1009', '3', 'COPY_ITEM_FINISHED_SUCCESS', 'The data was successfully зкопійовані');
INSERT INTO `be_AdminLanguage` VALUES ('1010', '3', 'COPY_ON_SELECTED_SITES', 'Copy selected websites');
INSERT INTO `be_AdminLanguage` VALUES ('1011', '3', 'COPY_ON_ALL_SITES', 'Copy to all sites');
INSERT INTO `be_AdminLanguage` VALUES ('1012', '3', 'COPY_ITEM', 'Copy');
INSERT INTO `be_AdminLanguage` VALUES ('1013', '3', 'PRELIMINARY_SAWE_FIELDS_REQUIRED', 'Fill in all obligatory fields');
INSERT INTO `be_AdminLanguage` VALUES ('1014', '3', 'FILEMANAGER_WATERMARK', 'No watermark is configuren!');

-- ----------------------------
-- Table structure for `be_ContactMessages`
-- ----------------------------
DROP TABLE IF EXISTS `be_ContactMessages`;
CREATE TABLE `be_ContactMessages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `viewId` int(11) unsigned NOT NULL DEFAULT '115',
  `langId` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(255) DEFAULT NULL,
  `emailTo` varchar(255) DEFAULT NULL,
  `emailFrom` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `formData` text,
  `urlReferer` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_view_contactmessages` (`viewId`),
  CONSTRAINT `fk_view_contactmessages` FOREIGN KEY (`viewId`) REFERENCES `be_View` (`viewId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of be_ContactMessages
-- ----------------------------

-- ----------------------------
-- Table structure for `be_Events`
-- ----------------------------
DROP TABLE IF EXISTS `be_Events`;
CREATE TABLE `be_Events` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET cp1251 NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_Events
-- ----------------------------
INSERT INTO `be_Events` VALUES ('1', 'user_registration', 'Реєстрація користувача', null);
INSERT INTO `be_Events` VALUES ('2', 'UserNewPasswordEvent', 'Зміна пароля користувачем', 'UserNewPasswordEvent');
INSERT INTO `be_Events` VALUES ('3', 'order_status_', 'Зміна статусу замовлення ', 'OrderStatusEvent');
INSERT INTO `be_Events` VALUES ('4', 'order_status_canceling', 'Зміна статусу замовлення canceling', 'OrderStatusEvent');
INSERT INTO `be_Events` VALUES ('5', 'order_status_paid', 'Зміна статусу замовлення paid', 'OrderStatusEvent');
INSERT INTO `be_Events` VALUES ('6', 'order_status_in progress', 'Зміна статусу замовлення in progress', 'OrderStatusEvent');

-- ----------------------------
-- Table structure for `be_Fields`
-- ----------------------------
DROP TABLE IF EXISTS `be_Fields`;
CREATE TABLE `be_Fields` (
  `fieldId` int(11) NOT NULL AUTO_INCREMENT,
  `viewId` int(11) unsigned NOT NULL DEFAULT '0',
  `fieldName` char(200) NOT NULL,
  `displayName` char(250) DEFAULT NULL,
  `fieldType` int(10) unsigned DEFAULT NULL,
  `rTableName` varchar(255) DEFAULT NULL,
  `rFieldName` varchar(255) DEFAULT NULL,
  `rSourcePointerField` varchar(255) DEFAULT NULL,
  `rSourceTableName` varchar(255) DEFAULT NULL,
  `rSourceLinkField` varchar(255) DEFAULT NULL,
  `rDisplayFields` varchar(255) DEFAULT NULL,
  `rSearchViewId` int(11) DEFAULT '0',
  `displayType` int(10) unsigned NOT NULL,
  `required` int(11) NOT NULL,
  `validation` int(11) NOT NULL,
  `groupId` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `orderNumber` int(10) unsigned NOT NULL,
  `visible` int(11) DEFAULT '1',
  `defaultValue` varchar(255) DEFAULT NULL,
  `availableValues` varchar(500) DEFAULT NULL,
  `width` int(11) unsigned DEFAULT NULL,
  `height` int(11) unsigned DEFAULT NULL,
  `className` varchar(1024) DEFAULT NULL,
  `phpCode` text CHARACTER SET utf8,
  `searchType` tinyint(1) unsigned DEFAULT '0',
  `participantSearch` tinyint(4) NOT NULL,
  `visibleInSearchResult` tinyint(4) NOT NULL,
  PRIMARY KEY (`fieldId`),
  KEY `viewId` (`viewId`),
  KEY `fk_fieldtype_fields` (`fieldType`),
  KEY `fk_group_fields` (`viewId`,`groupId`),
  CONSTRAINT `fk_fieldtype_fields` FOREIGN KEY (`fieldType`) REFERENCES `be_FieldTypes` (`FieldTypeId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3536 DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of be_Fields
-- ----------------------------
INSERT INTO `be_Fields` VALUES ('1', '1', 'langId', 'Language', '11', '', '', null, 'Langs', 'getWebSiteLangs', '', '0', '1', '0', '0', '1', '1', '1', '', null, '100', '0', null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('2', '1', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '3', '1', null, null, '25', null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('3', '1', 'viewId', 'Type of page', '30', 'be_View', 'viewId', '', null, null, 'be_View.name typeName', '0', '1', '0', '0', '1', '2', '1', null, null, '186', null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('4', '1', 'viewId', 'Class', '30', 'be_View', 'viewId', '', null, null, 'be_View.className classPage', '0', '1', '0', '0', '1', '5', '0', null, null, '200', null, null, null, '0', '0', '1');
INSERT INTO `be_Fields` VALUES ('5', '2', 'title', 'Name of the object', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '3', '1', null, null, '30', null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('6', '2', 'viewId', 'Object type', '30', 'be_View', 'viewId', null, null, null, 'be_View.name typeName', '0', '1', '0', '0', '1', '2', '1', null, null, null, null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('8', '3', 'listDescription', 'Description', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '3', '1', null, null, '20', null, null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('9', '3', 'listName', 'List name', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '2', '1', null, null, '20', null, null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('11', '4', 'title', 'Name of the object', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '2', '1', '0', null, null, null, null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('12', '4', 'viewId', 'Object type', '30', 'be_View', 'viewId', null, null, null, 'be_View.name typeName', '0', '1', '1', '0', '1', '1', '1', null, null, null, null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('13', '5', 'title', 'Name', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '2', '1', null, null, '20', null, null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('14', '6', 'text1', 'template templates/./.tpl', '7', null, null, null, null, null, null, '0', '2', '1', '0', '5', '4', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('15', '6', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '2', '2', '0', '6', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('16', '6', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('17', '6', 'number1', 'Navigation', '30', 'fe_Pages', 'id', null, null, null, 'fe_Pages.title title', '0', '1', '1', '0', '6', '5', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('18', '6', 'title', 'Name', '1', null, null, null, null, null, null, '0', '1', '0', '0', '4', '3', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('19', '6', 'langId', 'Language', '13', '', '', null, null, null, '', '2', '1', '1', '0', '3', '0', '1', '', null, '100', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('20', '8', 'number2', 'Tree', '29', 'fe_MenuItems', null, null, null, null, null, '9', '1', '1', '0', '2', '1', '1', '0', '20', null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('22', '8', 'langId', 'Language', '13', '', '', null, null, null, '', '2', '1', '1', '0', '1', '2', '1', '', null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('23', '8', 'title', 'The name of the navigation tree', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('25', '8', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('26', '8', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '5', '0', '8', null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('27', '9', 'treeItemName', 'Name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '2', '1', null, null, '20', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('28', '9', 'link', 'Page URL', '8', null, null, null, null, null, null, '1', '1', '1', '0', '0', '3', '1', null, null, '93', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('29', '9', 'id', 'ID', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '1', '0', null, null, '5', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('30', '9', 'rootId', '', '1', null, null, null, null, null, null, '0', '1', '0', '0', '0', '10', '0', null, null, '10', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('31', '9', 'visible', 'Show item', '6', null, null, null, null, null, null, '0', '1', '0', '0', '0', '6', '1', '1', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('32', '10', 'id', 'List Items', '33', 'be_ListItems', 'listId', 'id', null, 'orderNr', null, '11', '1', '1', '0', '0', '7', '1', null, null, null, '150', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('33', '10', 'viewId', 'display type', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '5', '0', '10', null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('35', '10', 'listDescription', 'Description list', '2', null, null, null, null, null, null, '0', '1', '1', '0', '0', '4', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('36', '10', 'listName', 'List name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '3', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('37', '10', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '1', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('42', '12', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('43', '12', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('44', '12', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('45', '12', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('46', '12', 'html', 'Content pages (HTML)', '3', null, null, null, null, null, null, '0', '1', '1', '0', '3', '1', '1', null, null, '650', '470', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('47', '12', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '12', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('48', '12', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('49', '12', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('50', '12', 'langId', 'Language', '13', '', '', null, null, null, '', '1', '1', '1', '0', '1', '3', '1', '', null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('63', '14', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('64', '14', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '2', '0', '14', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('65', '14', 'html', 'Text', '3', null, null, null, null, null, null, '0', '1', '1', '0', '0', '4', '1', null, null, '400', '400', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('66', '14', 'langId', 'Language', '13', '', '', null, null, null, '', '2', '1', '1', '0', '0', '1', '1', '', null, '100', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('67', '14', 'title', 'Name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '3', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('68', '15', 'langId', 'Language', '13', '', '', null, null, null, '', '2', '1', '1', '0', '1', '2', '1', '', null, '100', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('69', '15', 'title', 'Name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '1', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('70', '15', 'text1', 'Illustration', '7', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('71', '15', 'text2', 'Alternative text', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('72', '15', 'text3', 'Page URL', '8', null, null, null, null, null, null, '1', '1', '0', '0', '1', '5', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('73', '15', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '1', '0', '1', '1', '0', '15', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('74', '15', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('75', '16', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('76', '16', 'title', 'The name of the included module', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '3', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('77', '16', 'html', 'Software code', '2', null, null, null, null, null, null, '0', '1', '1', '0', '0', '4', '1', null, null, '65', '20', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('78', '16', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', '16', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('83', '18', 'shortDescription', 'Brief description', '2', null, null, null, null, null, null, '0', '1', '0', '0', '4', '1', '1', null, null, '50', '5', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('84', '18', 'text2', 'Ілюстраці', '7', null, '460x310_2', null, null, null, null, '0', '2', '0', '0', '3', '3', '1', null, null, '92', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('85', '18', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('87', '18', 'html', 'Full description(HTML)', '3', null, null, null, null, null, null, '0', '1', '1', '0', '4', '2', '1', null, null, '500', '100', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('88', '18', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('90', '18', 'langId', 'Language', '13', '', '', null, null, null, '', '1', '1', '1', '0', '1', '3', '1', '', null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('92', '18', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '18', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('93', '18', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', '3', null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('94', '18', 'text1', 'Mini figure', '7', null, '65x65_1', null, null, null, null, '0', '2', '0', '0', '3', '2', '1', null, null, '92', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('95', '18', 'id', 'Page ID', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('96', '18', 'dateStartVisible', 'Date news', '4', null, null, null, null, null, null, '0', '2', '0', '0', '3', '1', '1', null, null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('97', '18', 'text3', 'Great illustration (578x345)', '7', null, null, null, null, null, null, '0', '1', '0', '0', '3', '4', '1', null, null, '92', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('98', '18', 'visible', 'Show news', '6', null, null, null, null, null, null, '0', '1', '0', '0', '1', '7', '1', '1', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('99', '18', 'text5', 'Video 570 x n', '7', null, null, null, null, null, null, '0', '1', '0', '0', '3', '7', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('100', '19', 'introHtml', 'The introductory part', '3', null, null, null, null, null, null, '0', '1', '0', '0', '3', '3', '1', null, null, '650', '500', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('101', '19', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('102', '19', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '5', '0', '19', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('103', '19', 'number1', 'News category', '30', 'be_ListItems', 'id', null, null, null, 'be_ListItems.listItemName', '0', '1', '0', '0', '3', '1', '1', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('104', '19', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('105', '19', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('106', '19', 'id', 'Page ID', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '4', '0', null, null, '5', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('107', '19', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '86', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('108', '19', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '2', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('109', '19', 'langId', 'Language', '13', '', '', null, null, null, '', '1', '1', '1', '0', '1', '1', '1', '', null, '100', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('110', '19', 'number2', 'Number page', '1', null, null, null, null, null, null, '0', '1', '1', '0', '3', '2', '1', '5', null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('123', '22', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('124', '22', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', '22', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('125', '22', 'langId', 'Language', '13', '', '', null, null, null, '', '2', '1', '1', '0', '1', '3', '1', '', null, '100', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('126', '22', 'title', 'Header block', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('127', '22', 'id', 'List of questions', '32', 'be_PageContent', 'pageId', 'contentId', 'fe_PagesRelatedItems', 'id', 'fe_PagesRelatedItems.title, fe_PagesRelatedItems.text1, fe_PagesRelatedItems.text2', '23', '1', '1', '0', '2', '4', '1', null, null, '600', '200', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('128', '22', 'dateStartVisible', 'Start date', '4', null, null, null, null, null, null, '0', '1', '1', '0', '2', '2', '1', null, null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('129', '22', 'text1', 'Figure header', '7', null, null, null, null, null, null, '0', '1', '0', '0', '1', '5', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('130', '22', 'dateEndVisible', 'End date', '4', null, null, null, null, null, null, '0', '1', '1', '0', '2', '3', '1', null, null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('131', '22', 'text2', 'The theme of the survey', '2', null, null, null, null, null, null, '0', '1', '1', '0', '2', '1', '1', null, null, '60', '5', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('132', '23', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('133', '23', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '2', '0', '23', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('134', '23', 'title', 'Answer variant', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '3', '1', null, null, '23', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('135', '23', 'number1', 'Number of votes', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '5', '1', '0', null, '5', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('136', '24', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('137', '24', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '2', '0', '24', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('138', '24', 'title', 'Name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '4', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('139', '24', 'text1', 'SWF file', '7', null, null, null, null, null, null, '0', '1', '1', '0', '0', '5', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('140', '24', 'text2', 'XML file', '1', null, null, null, null, null, null, '0', '1', '0', '0', '0', '6', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('141', '24', 'langId', 'Language', '13', '', '', null, null, null, '', '2', '1', '1', '0', '0', '3', '1', '', null, '100', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('142', '24', 'number1', 'Width', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '8', '1', null, null, '5', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('143', '24', 'number2', 'Height', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '9', '1', null, null, '5', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('144', '24', 'number3', 'version of Flash player', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '10', '1', '8', null, '3', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('145', '24', 'text3', 'Background color', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '11', '1', null, null, '6', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('146', '24', 'text4', 'The name of the file ( English only)', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '7', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('223', '34', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('224', '34', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', '34', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('225', '34', 'shortDescription', 'Answer error', '2', null, null, null, null, null, null, '0', '1', '0', '0', '1', '8', '1', null, null, '30', '5', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('226', '34', 'langId', 'Language', '13', '', '', null, null, null, '', '2', '1', '1', '0', '1', '3', '1', '', null, '100', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('227', '34', 'title', 'Name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('230', '35', 'email', 'Email', '1', '', '', null, null, null, '', '0', '1', '0', '0', '1', '3', '1', null, null, '17', null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('231', '35', 'loginName', 'Login', '1', '', '', null, null, null, '', '0', '1', '0', '0', '1', '2', '1', null, null, '17', null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('232', '35', 'surname', 'Surname', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '1', '1', null, null, '17', null, null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('234', '36', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('235', '36', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', '36', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('236', '36', 'loginName', 'Login', '1', null, null, null, '', '', null, '0', '1', '1', '0', '1', '3', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('238', '36', 'email', 'email', '1', null, null, null, '', '', null, '0', '1', '1', '0', '1', '5', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('239', '36', 'name', 'Name', '1', null, null, null, '', '', null, '0', '1', '1', '0', '1', '6', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('240', '36', 'surname', 'Surname', '1', null, null, null, '', '', null, '0', '1', '1', '0', '1', '7', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('241', '36', 'siteUrl', 'Website', '1', null, null, null, '', '', null, '0', '1', '0', '0', '1', '8', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('248', '36', 'ip', 'Last IP', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '14', '1', null, null, '16', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('249', '36', 'registrationDate', 'Date реэстрації', '4', null, null, null, null, null, null, '0', '1', '1', '0', '1', '12', '1', null, null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('250', '36', 'lastVisitDate', 'Last visit', '4', null, null, null, null, null, null, '0', '1', '1', '0', '1', '13', '1', null, null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('251', '36', 'active', 'Status', '30', 'be_UserStatus', 'id', null, '', '', 'be_UserStatus.description', '0', '1', '1', '0', '1', '10', '1', '', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('252', '36', 'id', 'Jur. infa', '33', 'fe_Companies', 'userId', 'id', '', '', '', '37', '1', '1', '0', '2', '1', '1', null, '100', '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('254', '36', 'id', 'phones', '33', 'fe_Phones', 'userId', 'id', '', '', '', '49', '1', '1', '0', '1', '11', '1', null, '100', '670', '120', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('269', '39', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('270', '39', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('271', '39', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('272', '39', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '0', '0', '1', '5', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('273', '39', 'introHtml', 'The introductory part', '2', null, null, null, null, null, null, '0', '1', '1', '0', '3', '3', '1', null, null, '60', '5', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('274', '39', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '39', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('275', '39', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('276', '39', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('277', '39', 'langId', 'Language', '13', '', '', null, null, null, '', '1', '1', '1', '0', '1', '3', '1', '', null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('278', '40', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('279', '40', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '2', '0', '40', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('280', '40', 'text1', 'Brief description', '2', null, null, null, null, null, null, '0', '1', '0', '0', '0', '4', '1', null, null, '30', '5', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('281', '40', 'langId', 'Language', '13', '', '', null, null, null, '', '2', '1', '1', '0', '0', '1', '1', '', null, '100', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('282', '40', 'title', 'Name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '3', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('283', '40', 'text2', 'Search page', '8', null, null, null, null, null, null, '1', '1', '1', '0', '0', '5', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('295', '34', 'text3', 'The name of the field \"login\"', '1', null, null, null, null, null, null, '1', '1', '1', '0', '2', '2', '1', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('296', '34', 'text8', 'The label on the button to exit', '1', null, null, null, null, null, null, '0', '1', '1', '0', '2', '7', '1', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('297', '34', 'text1', 'The text of the link to the registration form', '1', null, null, null, null, null, null, '0', '1', '1', '0', '2', '1', '1', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('299', '34', 'text4', 'The name of the field \"password\"', '1', null, null, null, null, null, null, '0', '1', '1', '0', '2', '3', '1', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('300', '34', 'text5', 'The label on the button send', '1', null, null, null, null, null, null, '0', '1', '1', '0', '2', '4', '1', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('304', '39', 'text1', 'Error search', '2', null, null, null, null, null, null, '0', '1', '1', '0', '3', '4', '1', null, null, '60', '5', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('305', '39', 'text2', 'The text in the search result', '2', null, null, null, null, null, null, '0', '1', '1', '0', '3', '5', '1', null, null, '60', '5', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('540', '7', 'number2', 'Tree', '29', 'fe_ProductsCategories', null, null, null, null, null, '17', '2', '1', '0', '2', '1', '1', '0', '0', null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('542', '7', 'langId', 'Language', '13', '', '', null, null, null, '', '2', '1', '1', '0', '1', '2', '1', '', null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('543', '7', 'title', 'The name of the navigation tree', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('544', '7', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('545', '7', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '5', '0', '7', null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('559', '1', 'dateStartVisible', 'Creation date', '4', null, null, null, null, null, null, '0', '3', '0', '0', '1', '4', '1', null, null, '9', null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('561', '20', 'treeItemName', 'Name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '3', '1', null, null, '20', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('562', '20', 'link', 'Page URL', '8', null, null, null, null, null, null, '1', '1', '1', '0', '0', '4', '1', null, null, '93', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('563', '20', 'id', 'ID', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '1', '0', null, null, '5', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('564', '20', 'rootId', '', '1', null, null, null, null, null, null, '0', '1', '0', '0', '0', '10', '0', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('565', '20', 'visible', 'Show item', '6', null, null, null, null, null, null, '0', '1', '0', '0', '0', '7', '1', '1', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('566', '20', 'moduleId', 'Module', '30', 'be_ListItems', 'id', null, null, null, 'be_ListItems.listItemName', '0', '1', '1', '0', '0', '2', '1', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('604', '9', 'imageActive', 'Figure (active)', '7', null, null, null, null, null, null, '0', '1', '0', '0', '0', '4', '1', null, null, '93', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('605', '20', 'imageActive', 'Figure (active)', '7', null, null, null, null, null, null, '0', '1', '0', '0', '0', '5', '1', null, null, '93', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('606', '9', 'imageInactive', 'Figure (inactive)', '7', null, null, null, null, null, null, '0', '1', '0', '0', '0', '5', '1', '', null, '93', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('607', '20', 'imageInactive', 'Figure (inactive)', '7', null, null, null, null, null, null, '0', '1', '0', '0', '0', '6', '1', null, null, '93', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('622', '1', 'viewId', 'the type of page(hidden)', '30', 'be_View', 'viewId', 'viewType', null, null, 'be_View.viewType viewType', '0', '2', '0', '0', '1', '6', '0', '1,2', '', null, null, null, null, '1', '1', '0');
INSERT INTO `be_Fields` VALUES ('623', '2', 'viewId', 'the type of page(hidden)', '30', 'be_View', 'viewId', 'viewType', null, null, 'be_View.viewType viewType', '0', '2', '0', '0', '1', '4', '0', '3,8', null, null, null, null, null, '1', '1', '0');
INSERT INTO `be_Fields` VALUES ('637', '76', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('638', '76', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('639', '76', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('640', '76', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '6', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('641', '76', 'introHtml', 'Text confirmation', '3', null, null, null, null, null, null, '0', '1', '1', '0', '3', '1', '1', null, null, '650', '500', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('642', '76', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '76', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('643', '76', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('644', '76', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '7', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('645', '76', 'langId', 'Language', '13', '', '', null, null, null, '', '1', '1', '1', '0', '1', '3', '1', '', null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('646', '76', 'outroHtml', 'The text of the error', '3', null, null, null, null, null, null, '0', '0', '0', '0', '4', '1', '1', null, null, '620', '500', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('862', '53', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '1', '0', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('863', '53', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '2', '0', '53', null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('864', '53', 'langId', 'Language', '13', '', '', null, null, null, '', '2', '1', '1', '0', '0', '3', '1', '', null, '100', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('865', '53', 'title', 'Header', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '4', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('866', '53', 'number1', 'The number of stories that you want to skip', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '5', '1', null, null, '3', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('867', '53', 'number2', 'The number of stories shown', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '6', '1', null, null, '3', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('901', '25', 'introHtml', 'The introductory part', '3', null, null, null, null, null, null, '0', '1', '0', '0', '3', '3', '1', null, null, '650', '500', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('902', '25', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '150', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('903', '25', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '5', '0', '25', null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('904', '25', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('905', '25', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '40', '10', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('906', '25', 'id', 'Page ID', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '4', '0', null, null, '5', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('907', '25', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '86', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('908', '25', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '2', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('909', '25', 'langId', 'Language', '13', '', '', null, null, null, '', '1', '1', '1', '0', '1', '1', '1', '', null, '100', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('910', '25', 'number2', 'Number page', '1', null, null, null, null, null, null, '0', '1', '1', '0', '3', '1', '1', '9', null, '10', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('911', '25', 'number3', 'Category', '30', 'be_ListItems', 'id', null, null, null, 'be_ListItems.listItemName', '0', '1', '1', '0', '3', '2', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('912', '26', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('913', '26', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', '26', null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('914', '26', 'langId', 'Language', '13', '', '', null, null, null, '', '1', '1', '1', '0', '1', '3', '1', '', null, '100', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('915', '26', 'title', 'Photo gallery name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('916', '26', 'id', 'List of photo', '32', 'be_PageContent', 'pageId', 'contentId', 'fe_PagesRelatedItems', 'id', 'fe_PagesRelatedItems.title, fe_PagesRelatedItems.text1, fe_PagesRelatedItems.text2', '27', '3', '1', '0', '4', '1', '1', null, null, '400', '400', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('917', '26', 'number2', 'Number of photos per page', '1', null, null, null, null, null, null, '0', '1', '0', '0', '3', '4', '0', null, null, '3', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('918', '26', 'text1', 'Main photo 180х120', '7', null, null, null, null, null, null, '0', '1', '0', '0', '3', '1', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('919', '26', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '5', '1', '3', null, '150', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('920', '26', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '40', '10', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('921', '26', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('922', '26', 'introHtml', 'Introductory text', '3', null, null, null, null, null, null, '0', '1', '0', '0', '3', '2', '1', null, null, '400', '150', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('923', '26', 'dateStartVisible', 'Creation date', '4', null, null, null, null, null, null, '0', '1', '1', '0', '3', '3', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('925', '26', 'number4', 'Category', '30', 'be_ListItems', 'id', null, null, null, 'be_ListItems.listItemName', '0', '1', '0', '0', '3', '7', '1', null, null, '200', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('928', '27', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '1', '0', '0', '2', '0', '27', null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('929', '27', 'id', 'Page ID', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '1', '0', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('930', '27', 'text3', 'Photo', '7', null, null, null, null, null, null, '0', '1', '1', '0', '0', '5', '1', null, null, '97', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('932', '27', 'shortDescription', 'Brief description', '1', null, null, null, null, null, null, '0', '1', '0', '0', '0', '6', '1', null, null, '97', '3', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('933', '27', 'text4', 'General description', '1', null, null, null, null, null, null, '0', '1', '0', '0', '0', '4', '1', '', null, '97', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('959', '28', 'description', 'Text', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '2', '1', null, null, '20', null, null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('961', '28', 'langId', 'Language', '11', '', '', null, 'Langs', 'getWebSiteLangs', '', '0', '1', '0', '0', '1', '1', '1', '', null, '100', '0', null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('962', '29', 'description', 'Text', '2', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '35', '5', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('963', '29', 'keyword', 'Key', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '3', '1', null, null, '30', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('964', '29', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('965', '29', 'langId', 'Language', '30', 'be_Languages', 'id', null, null, null, 'be_Languages.code langcode', '0', '1', '1', '0', '1', '2', '1', '1', null, '50', null, null, null, '0', '0', '1');
INSERT INTO `be_Fields` VALUES ('998', '12', 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('999', '18', 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1000', '19', 'seoTitle', 'SEO title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1098', '75', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1099', '75', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1100', '75', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1101', '75', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1102', '75', 'introHtml', 'The introductory part', '3', null, null, null, null, null, null, '0', '1', '1', '0', '3', '2', '1', null, null, '650', '500', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1103', '75', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '75', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1104', '75', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1105', '75', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '200', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1106', '75', 'langId', 'Language', '13', '', '', null, null, null, '', '1', '1', '1', '0', '1', '3', '1', '', null, null, '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1107', '75', 'shortDescription', 'Data entry error', '2', null, null, null, null, null, null, '0', '1', '1', '0', '3', '1', '1', null, null, '40', '4', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1110', '75', 'text3', 'Registration confirmation page', '8', null, null, null, null, null, null, '1', '1', '1', '0', '4', '3', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('1111', '75', 'text1', 'The text of the successful registration', '2', null, null, null, null, null, null, '0', '1', '1', '0', '4', '4', '1', null, null, '40', '4', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1112', '75', 'text2', 'The text failed registration', '2', null, null, null, null, null, null, '0', '1', '1', '0', '4', '5', '1', null, null, '40', '4', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1144', '33', 'introHtml', 'The introductory part', '3', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '650', '500', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1145', '33', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '33', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1146', '33', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1147', '33', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '5', '1', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1148', '33', 'langId', 'Language', '13', '', '', null, null, null, '', '1', '1', '1', '0', '1', '3', '1', '', null, null, '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1149', '33', 'text1', 'Data entry error', '2', null, null, null, null, null, null, '0', '1', '1', '0', '2', '2', '1', null, null, '50', '3', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1150', '33', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '92', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1151', '33', 'text2', 'A message stored data', '2', null, null, null, null, null, null, '0', '1', '1', '0', '2', '3', '1', null, null, '50', '3', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1173', '77', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1174', '77', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1175', '77', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1176', '77', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1177', '77', 'html', 'Content pages (HTML)', '3', null, null, null, null, null, null, '0', '1', '1', '0', '3', '1', '1', null, null, '650', '300', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1178', '77', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '77', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1179', '77', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1180', '77', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1181', '77', 'langId', 'Language', '13', '', '', null, null, null, '', '1', '1', '1', '0', '1', '3', '1', '', null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1182', '77', 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('1212', '77', 'text1', 'A message if a user is not in the database', '2', null, null, null, null, null, null, '0', '1', '0', '0', '3', '2', '1', null, null, '65', '2', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('1213', '77', 'text2', 'Сторінка, сервіс не працює', '8', null, null, null, null, null, null, '1', '1', '0', '0', '4', '1', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('1639', '76', 'text1', 'Email the moderators', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1653', '76', 'html', 'Additional description', '3', null, null, null, null, null, null, '0', '0', '0', '0', '5', '1', '1', null, null, '620', '500', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1676', '53', 'text3', 'List of news', '8', null, null, null, null, null, null, '1', '1', '1', '0', '0', '7', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('1690', '18', 'text6', 'Code to embed video 570 x n', '2', null, null, null, null, null, null, '0', '1', '0', '0', '3', '8', '1', null, null, '70', '4', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1696', '18', 'text7', 'The name of the video', '1', null, null, null, null, null, null, '0', '1', '0', '0', '3', '6', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('1697', '18', 'id', 'Photo', '32', 'be_PageContent', 'pageId', 'contentId', 'fe_PagesRelatedItems', 'id', 'fe_PagesRelatedItems.title', '27', '3', '0', '0', '5', '3', '1', null, null, '610', '400', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('1710', '18', 'text8', 'Photo gallery name', '1', null, null, null, null, null, null, '0', '1', '0', '0', '5', '1', '1', null, null, '97', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('1713', '18', 'text9', 'Author', '1', null, null, null, null, null, null, '0', '1', '0', '0', '5', '2', '1', null, null, '97', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('1714', '34', 'text7', 'Redirect Error', '8', null, null, null, null, null, null, '1', '1', '1', '0', '1', '5', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1726', '18', 'text10', 'Photo for list of media (150x85)', '7', null, null, null, null, null, null, '0', '1', '0', '0', '3', '5', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('1727', '15', 'number1', 'A new window', '6', null, null, null, null, null, null, '0', '1', '0', '0', '1', '6', '1', '0', null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('1943', '31', 'email', 'Email', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '3', '1', null, null, '25', null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('1944', '31', 'name', 'Name Surname', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '2', '1', null, null, '25', null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('1945', '31', 'username', 'Login', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '1', '1', null, null, '25', null, null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('1946', '31', 'lastLogin', 'Date login', '4', null, null, null, null, null, null, '0', '3', '0', '0', '1', '4', '1', null, null, '25', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1948', '32', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1949', '32', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', '32', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1950', '32', 'name', 'Name Surname', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '5', '1', null, null, '25', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1951', '32', 'email', 'Email', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '25', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1952', '32', 'username', 'Login', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '25', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('1953', '32', 'id', 'New password', '10', null, null, null, 'User', 'setRedactorPassword', null, '0', '2', '0', '0', '1', '6', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2107', '11', 'description', 'Category description', '2', null, null, null, null, null, null, '0', '1', '0', '0', '1', '3', '1', null, null, '35', '5', null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('2108', '11', 'visible', 'Active', '6', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, null, null, null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('2109', '11', 'listItemName', 'The text of the record', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '2', '1', null, null, '30', null, null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('2110', '11', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2111', '11', 'id', 'Translations', '33', 'be_ListItemTranslation', 'listItemId', 'id', null, null, null, '38', '1', '0', '0', '1', '5', '1', '', null, '670', '250', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2112', '108', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2113', '108', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2114', '108', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2115', '108', 'codeName', 'Code page', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2116', '108', 'html', 'Content pages (HTML)', '3', null, null, null, null, null, null, '0', '1', '1', '0', '3', '1', '1', null, null, '650', '470', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2117', '108', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '108', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2118', '108', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2119', '108', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2120', '108', 'langId', 'Language', '13', '', '', null, null, null, '', '1', '1', '1', '0', '1', '3', '1', '', null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2121', '108', 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2186', '1', 'codeName', '', '12', null, null, null, null, null, null, '0', '0', '1', '0', '1', '7', '1', null, null, '86', null, null, null, '0', '0', '1');
INSERT INTO `be_Fields` VALUES ('2205', '114', 'langId', 'Language', '13', '', '', null, null, null, '', '0', '2', '1', '0', '1', '1', '1', '', null, '100', '0', null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('2207', '115', 'formData', 'Data', '2', null, null, null, null, null, null, '0', '1', '0', '0', '1', '8', '1', null, null, '60', '18', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2208', '115', 'emailTo', 'emailto parameter', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '4', '1', null, null, '50', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2209', '115', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2210', '115', 'langId', 'Language', '30', 'be_Languages', 'id', null, null, null, 'be_Languages.code langcode', '0', '1', '1', '0', '1', '2', '1', '1', null, '50', null, null, null, '0', '0', '1');
INSERT INTO `be_Fields` VALUES ('2211', '114', 'emailFrom', 'emailFrom', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '3', '1', null, null, '20', null, null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('2212', '114', 'name', 'Name', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '20', null, null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('2213', '114', 'phone', 'Telephone', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '5', '1', null, null, '20', null, null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('2214', '115', 'emailFrom', 'emailFrom', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '5', '1', null, null, '50', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2215', '115', 'name', 'Name', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '6', '1', null, null, '50', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2216', '115', 'phone', 'Telephone', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '7', '1', null, null, '50', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2217', '114', 'type', 'Type', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '2', '1', null, null, '20', null, null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('2218', '115', 'type', 'Type', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '3', '1', null, null, '50', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2219', '116', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2220', '116', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2221', '116', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2222', '116', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2223', '116', 'html', 'Content pages (HTML)', '3', null, null, null, null, null, null, '0', '1', '1', '0', '3', '1', '1', null, null, '650', '470', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2224', '116', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '116', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2225', '116', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2226', '116', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2227', '116', 'langId', 'Language', '13', '', '', null, null, null, '', '1', '1', '1', '0', '1', '3', '1', '', null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2228', '116', 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2231', '116', 'number1', 'Navigation tree', '30', 'fe_Pages', 'id', null, null, null, 'fe_Pages.title title', '0', '1', '1', '0', '3', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2238', '16', 'langId', 'Language', '13', '', '', null, null, null, '', '2', '1', '1', '0', '1', '3', '1', '', null, '100', '0', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2239', '60', 'name', 'Name', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '1', '1', null, null, '20', null, null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('2240', '60', 'code', 'Code', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '2', '1', null, null, '20', null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('2248', '117', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '1', '0', '0', '2', '0', '117', null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2249', '117', 'id', 'ID', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '1', '0', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2255', '117', 'text1', 'Photo', '7', null, '1', null, null, null, null, '0', '2', '1', '0', '0', '4', '1', null, null, '97', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2264', '18', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2265', '18', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2266', '61', 'id', 'The identifier of the list', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '1', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2267', '61', 'viewId', 'display type', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '5', '0', '10', null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2268', '61', 'name', 'Name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '3', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2269', '61', 'code', 'Language code', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '3', '1', null, null, '6', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2270', '61', 'metatag', 'Code in the meta tags of a site\nISO 639-1 Code', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '3', '1', null, null, '6', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2274', '54', 'name', 'Name', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '1', '1', null, null, '20', null, null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('2275', '54', 'URL', 'URL', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '2', '1', null, null, '50', '0', null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('2288', '55', 'viewId', 'display type', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '2', '0', '55', null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2289', '55', 'name', 'Name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '50', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2290', '55', 'URL', 'The domain<br><small>(without http://)</small>', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '50', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2291', '55', 'useCache', 'Enable your cache', '6', null, null, null, null, null, null, '0', '1', '0', '0', '1', '9', '1', '0', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2292', '55', 'useSMTP', 'Use SMTP', '6', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', '0', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2293', '55', 'SMTPServer', 'SMTP server', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '50', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2294', '55', 'SMTPUser', 'SMTP login', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '4', '1', null, null, '50', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2295', '55', 'SMTPPassword', 'SMTP password', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '5', '1', null, null, '50', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2296', '55', 'defaultAvatarImage', 'A default avatar', '7', null, null, null, null, null, null, '0', '1', '0', '0', '3', '1', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2313', '55', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2315', '13', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2316', '13', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '2', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2317', '13', 'id', 'Area 1', '31', 'fe_PageObjectsInAreas', 'masterPageId', 'pageObjectId ', 'fe_Pages', 'id', 'fe_Pages.title title', '2', '1', '0', '0', '2', '2', '1', null, '6', '400', '6', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2318', '13', 'id', 'Area 2', '31', 'fe_PageObjectsInAreas', 'masterPageId', 'pageObjectId ', 'fe_Pages', 'id', 'fe_Pages.title title', '2', '1', '0', '0', '2', '3', '1', null, '6', '400', '6', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2319', '13', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '3', '0', '13', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2320', '13', 'id', 'System area (HEAD)', '31', 'fe_PageObjectsInAreas', 'masterPageId', 'pageObjectId ', 'fe_Pages', 'id', 'fe_Pages.title title', '4', '1', '0', '0', '1', '3', '1', null, '20', '400', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2321', '13', 'id', 'Area 3', '31', 'fe_PageObjectsInAreas', 'masterPageId', 'pageObjectId ', 'fe_Pages', 'id', 'fe_Pages.title title', '2', '1', '0', '0', '3', '1', '1', null, '10', '400', '6', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2322', '13', 'id', 'Region 4', '31', 'fe_PageObjectsInAreas', 'masterPageId', 'pageObjectId ', 'fe_Pages', 'id', 'fe_Pages.title title', '2', '1', '0', '0', '3', '1', '1', null, '10', '400', '6', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2323', '13', 'id', 'Area 5', '31', 'fe_PageObjectsInAreas', 'masterPageId', 'pageObjectId ', 'fe_Pages', 'id', 'fe_Pages.title title', '2', '1', '0', '0', '4', '1', '1', null, '10', '400', '6', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2324', '13', 'id', 'Area 6', '31', 'fe_PageObjectsInAreas', 'masterPageId', 'pageObjectId ', 'fe_Pages', 'id', 'fe_Pages.title title', '2', '1', '0', '0', '4', '2', '1', null, '10', '400', '6', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2325', '13', 'id', 'Area 7', '31', 'fe_PageObjectsInAreas', 'masterPageId', 'pageObjectId ', 'fe_Pages', 'id', 'fe_Pages.title title', '2', '1', '0', '0', '5', '2', '1', null, '10', '400', '6', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2326', '13', 'id', 'Region 8', '31', 'fe_PageObjectsInAreas', 'masterPageId', 'pageObjectId ', 'fe_Pages', 'id', 'fe_Pages.title title', '2', '1', '0', '0', '5', '2', '1', null, '10', '400', '6', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2327', '13', 'langId', 'Language', '13', '', '', null, null, null, '', '5', '1', '1', '0', '1', '2', '1', '', null, '100', '0', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2330', '55', 'multiLanguage', 'Enable multilingual', '6', null, null, null, null, null, null, '0', '1', '0', '0', '4', '1', '1', '1', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2352', '33', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2374', '83', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '90', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2375', '83', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2376', '83', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2377', '83', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2379', '83', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '83', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2380', '83', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2381', '83', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2382', '83', 'langId', 'Language', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '3', '1', null, null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2383', '83', 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2385', '83', 'text2', 'User page (link)', '8', null, null, null, null, null, null, '1', '1', '1', '0', '3', '2', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2386', '83', 'text3', 'Feedback (link)', '8', null, null, null, null, null, null, '1', '1', '1', '0', '3', '3', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2388', '77', 'introHtml', 'Message after submitting the form', '3', null, null, null, null, null, null, '0', '1', '1', '0', '3', '2', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2402', '84', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2403', '84', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2404', '84', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2405', '84', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2407', '84', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '84', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2408', '84', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2409', '84', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2410', '84', 'langId', 'Language', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '3', '1', null, null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2411', '84', 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2412', '84', 'text1', 'Personal account of the user (link)', '8', null, null, null, null, null, null, '1', '1', '1', '0', '3', '1', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2413', '84', 'text2', 'Change the data (link)', '8', null, null, null, null, null, null, '1', '1', '1', '0', '3', '2', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2419', '62', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2420', '62', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', '62', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2421', '62', 'langId', 'Language', '13', null, null, null, null, null, null, '2', '1', '1', '0', '1', '1', '1', null, null, '100', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2422', '62', 'title', 'Name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2423', '62', 'number1', 'Show active language', '6', null, null, null, null, null, null, '0', '1', '0', '0', '1', '3', '1', '1', null, null, null, null, null, '0', '0', '1');
INSERT INTO `be_Fields` VALUES ('2425', '55', 'id', 'Site language', '33', 'be_WebsiteLanguages', 'websiteId', 'id', '', '', '', '56', '1', '1', '0', '4', '1', '1', null, '100', '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2426', '55', 'email', 'email default site (from)', '1', null, null, null, null, null, null, '0', '1', '1', '0', '2', '1', '1', null, null, '50', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2429', '55', 'dateFormat', 'Date format is <br>(d - day of the month<br>dd is the day of month (two digits)<br>m - month of the year<br>mm - the month of the year (two digits)<br>y - year (two digits)<br>yy - year (four digits))', '1', null, null, null, null, null, null, '0', '1', '1', '0', '3', '4', '1', 'dd.mm.yy', null, '50', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2430', '32', 'roleId', 'Role', '30', 'tbl_Roles', 'id', null, null, null, 'tbl_Roles.title title', '0', '1', '1', '0', '1', '7', '1', '', '', '200', '0', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2446', '120', 'viewId', '', '1', null, null, null, null, null, null, null, '1', '0', '0', '1', '1', '0', '120', '', null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2447', '120', 'id', 'ID', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '', null, '5', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2448', '120', 'title', 'Header', '1', null, null, null, null, null, null, null, '1', '1', '0', '1', '2', '1', null, null, '86', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2449', '120', 'id', 'Menu', '10', null, null, null, 'Role', 'websiteAdminRelation', null, null, '2', '0', '0', '1', '3', '1', null, null, '200', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2451', '121', 'title', 'Header', '1', null, null, null, null, null, null, '0', '1', '1', '1', '1', '1', '1', null, null, '20', null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('2457', '32', 'id', 'Accessible web sites', '10', null, null, null, 'Website', 'websiteAdminRelation', null, '0', '2', '0', '0', '2', '1', '1', null, null, '200', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2460', '63', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '1', '0', '1', '2', '0', '63', null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2461', '63', 'id', 'Page ID', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2462', '55', 'id', 'List of sizes', '33', 'be_ImageSizes', 'websiteId', 'id', '', '', '', '63', '3', '1', '0', '5', '3', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2473', '63', 'title', 'Name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '50', null, null, null, '0', '0', '1');
INSERT INTO `be_Fields` VALUES ('2474', '63', 'width', 'Width', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '5', null, null, null, '0', '0', '1');
INSERT INTO `be_Fields` VALUES ('2475', '63', 'height', 'Height', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '6', '1', null, null, '5', null, null, null, '0', '0', '1');
INSERT INTO `be_Fields` VALUES ('2476', '55', 'useImageProcessing', 'To enable the processing of images', '6', null, null, null, null, null, null, '0', '1', '0', '0', '5', '1', '1', '0', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2479', '61', 'langImage', 'Icon language (16x11)', '7', null, '', null, null, null, null, '0', '1', '0', '0', '0', '6', '1', null, null, '92', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2493', '56', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2494', '56', 'masterPageId', 'The basic pattern language', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '2', '1', null, null, '265', null, null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('2495', '56', 'langId', 'Language', '30', 'be_Languages', 'id', null, null, null, 'be_Languages.code langcode', '0', '1', '1', '0', '1', '3', '1', '1', null, '100', '0', null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('2496', '56', 'defaultLang', 'Primary language of the site', '6', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, null, null, null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('2499', '56', 'defaultUrl', 'Main page<br> selected language', '8', null, null, null, null, null, null, '1', '1', '0', '0', '1', '5', '1', null, null, '93', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2500', '122', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2501', '122', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2502', '122', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2503', '122', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2504', '122', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '122', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2505', '122', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2506', '122', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2507', '122', 'langId', 'Language', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '3', '1', null, null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2508', '122', 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2509', '2', 'langId', 'Language', '11', '', '', null, 'Langs', 'getWebSiteLangs', '', '0', '1', '0', '0', '1', '1', '1', '', null, '100', '0', null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('2514', '5', 'langId', 'Language', '11', '', '', null, 'Langs', 'getWebSiteLangs', '', '0', '1', '0', '0', '1', '1', '1', '', null, '100', '0', null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('2516', '123', 'title', 'Name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2517', '123', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '123', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2518', '123', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2519', '124', 'title', 'Name', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '1', '1', null, null, '20', null, null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('2520', '123', 'image', 'Image', '7', null, '', null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '92', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2521', '125', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2522', '125', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2523', '125', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2524', '125', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2525', '125', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '125', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2526', '125', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2527', '125', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2528', '125', 'langId', 'Language', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '3', '1', null, null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2529', '125', 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2530', '125', 'number1', 'The number of cities on the page', '1', null, null, null, null, null, null, '0', '1', '1', '0', '3', '1', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2531', '125', 'number2', 'The minimum number of population', '1', null, null, null, null, null, null, '0', '1', '1', '0', '3', '2', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2532', '32', 'isAccess', 'Access to all site content', '6', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2533', '55', 'useWaterMarks', 'Use watermarks', '6', null, null, null, null, null, null, '0', '1', '0', '0', '5', '2', '1', '0', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2534', '126', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2535', '126', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '2', '0', '126', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2536', '126', 'html', 'Text', '3', null, null, null, null, null, null, '0', '1', '0', '0', '0', '4', '1', null, null, '400', '400', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2537', '126', 'langId', 'Language', '13', null, null, null, null, null, null, '2', '1', '1', '0', '0', '1', '1', null, null, '100', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2538', '126', 'title', 'Name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '3', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2562', '35', 'registrationDate', 'Date of registration', '4', null, null, null, null, null, null, '0', '3', '0', '0', '1', '4', '1', null, null, '9', null, null, null, '0', '1', '0');
INSERT INTO `be_Fields` VALUES ('2563', '35', 'active', 'Status', '30', 'be_UserStatus', 'id', null, null, null, 'be_UserStatus.description', '0', '1', '1', '0', '1', '10', '1', null, null, null, null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('2564', '63', 'useWatermark', 'Use watermark', '6', null, null, null, null, null, null, '0', '1', '0', '0', '1', '7', '1', '0', null, null, null, null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('2565', '63', 'isProportion', 'Maintain aspect ratio', '6', null, null, null, null, null, null, '0', '1', '0', '0', '1', '8', '1', '1', null, null, null, null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('2567', '63', 'folderName', 'Directory name', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '50', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2569', '89', 'name', 'Name', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '3', '1', null, null, '60', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2570', '89', 'countryCode', 'Country code', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '2', '1', null, null, '30', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2571', '89', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2572', '89', 'isPpl', 'isPpl', '6', null, null, null, null, null, null, '0', '1', '0', '0', '1', '8', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2573', '89', 'type', 'Type', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '9', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2574', '89', 'population', 'Population', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2575', '89', 'geoId', 'geoId', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '10', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2576', '89', 'parentId', 'parentId', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '11', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2577', '89', 'id', 'Translations', '33', 'fe_GeoTranslation', 'geoNameId', 'id', null, null, null, '90', '1', '0', '0', '2', '1', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2578', '90', 'alternateName', 'Name', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '3', '1', null, null, '35', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2579', '90', 'content', 'description', '3', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '650', '500', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2580', '90', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2581', '90', 'langId', 'Language', '30', 'be_Languages', 'id', null, null, null, 'be_Languages.code langcode', '0', '1', '1', '0', '1', '2', '1', '1', null, '50', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2679', '89', 'middleImage', 'Average figure (150x100)', '7', null, '150x100_146', null, null, null, null, '0', '2', '0', '0', '1', '13', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2680', '89', 'bigImage', 'Large picture (200x150)', '7', null, '200x150_147', null, null, null, null, '0', '2', '0', '0', '1', '14', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2715', '91', 'type', 'Type', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '1', '1', null, null, '20', null, null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('2716', '91', '92 as searchedViewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, null, null, null, null, '0', '0', '1');
INSERT INTO `be_Fields` VALUES ('2719', '92', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2720', '92', 'type', 'Type', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '6', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2721', '92', 'metrics', 'metrics', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '7', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2722', '92', 'level', 'level', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '8', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2723', '92', 'id', 'Translations', '33', 'fe_GeoTypeTranslation', 'geoTypeId', 'id', null, null, null, '93', '1', '0', '0', '2', '1', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2726', '93', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2727', '93', 'sing', 'Name', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '3', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2728', '93', 'plr', 'Name plural', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2730', '93', 'langId', 'Language', '30', 'be_Languages', 'id', null, null, null, 'be_Languages.code langcode', '0', '1', '1', '0', '1', '2', '1', '1', null, '50', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2731', '129', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2732', '129', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '2', '0', '129', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2733', '129', 'langId', 'Language', '13', null, null, null, null, null, null, '2', '1', '1', '0', '0', '1', '1', null, null, '100', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2734', '129', 'title', 'Name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '3', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2736', '63', 'id', '', '10', null, null, null, 'ImageSizeCode', 'imageSizeCode', '63_width_Ширина[&]63_height_Висота', '0', '2', '0', '0', '1', '1', '0', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2737', '128', 'id', 'Page ID', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '4', '0', null, null, '5', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2738', '128', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '5', '0', '128', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2739', '128', 'langId', 'Language', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '1', '1', null, null, '100', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2740', '128', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '2', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2741', '128', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '86', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2742', '128', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2743', '128', 'seoTitle', 'SEO title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2744', '128', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2745', '128', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2746', '128', 'introHtml', 'The introductory part', '3', null, null, null, null, null, null, '0', '1', '0', '0', '3', '3', '1', null, null, '650', '500', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2747', '127', 'langId', 'Language', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '3', '1', null, null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2748', '127', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '127', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2749', '127', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', '3', null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2750', '127', 'id', 'Page ID', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2751', '127', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2752', '127', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2753', '127', 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2754', '127', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2755', '127', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2756', '127', 'html', 'Full description(HTML)', '3', null, null, null, null, null, null, '0', '1', '1', '0', '3', '2', '1', null, null, '500', '100', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2757', '127', 'text1', 'Official partner logo', '7', null, '150x100_146', null, null, null, null, '0', '2', '1', '0', '3', '2', '1', null, null, '92', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2758', '127', 'text2', 'Official partner logo', '7', null, '200x150_147', null, null, null, null, '0', '2', '1', '0', '3', '2', '1', null, null, '92', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2759', '127', 'number1', 'Frequency display (0..100)', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '11', '1', '50', null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2760', '130', 'title', 'File name', '1', null, null, null, null, null, null, '0', '2', '1', '0', '1', '3', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2761', '130', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2762', '131', 'title', 'Image', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '1', '1', null, null, '20', null, null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('2763', '130', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '130', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2764', '132', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '1', '0', '1', '2', '0', '132', null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2765', '132', 'id', 'Page ID', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2766', '130', 'id', 'Goal data', '33', 'be_ImageDescription', 'imageId', 'id', '', '', '', '132', '1', '0', '0', '1', '4', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2768', '132', 'objectName', 'Name of the object', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '5', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2769', '132', 'workName', 'The title of the work', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '6', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2770', '132', 'author', 'Author', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '7', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2771', '132', 'authorUrl', 'URL of the author', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '8', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2772', '132', 'langId', 'Language', '30', 'be_Languages', 'id', null, '', '', 'be_Languages.code title', '0', '1', '1', '0', '1', '4', '1', '', null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2773', '89', 'iconImage', 'Icon (30x30)', '7', null, '30x30_148', null, null, null, null, '0', '2', '0', '0', '1', '12', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2774', '89', 'id', 'Images', '33', 'be_GeoNameImages', 'objectId', 'id', '', '', '', '97', '1', '0', '0', '3', '1', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2775', '94', 'number2', 'Directory tree', '29', 'poi_Types', null, null, 'PoiTypesTree', '', null, '95', '1', '1', '0', '0', '3', '1', '0', '0', null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2777', '94', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '1', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2778', '94', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '2', '0', '94', null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2796', '95', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2797', '95', 'treeItemName', 'The name of the type (transl)', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '2', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2798', '95', 'icon', 'image', '7', null, null, null, null, null, null, '0', '1', '0', '0', '1', '3', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2800', '95', 'id', 'Translations', '33', 'poi_TypeTranslation', 'poiTypeId', 'id', null, null, null, '96', '1', '0', '0', '2', '1', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2801', '96', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2802', '96', 'name', 'Name', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '3', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2804', '96', 'langId', 'Language', '30', 'be_Languages', 'id', null, null, null, 'be_Languages.code langcode', '0', '1', '1', '0', '1', '2', '1', '1', null, '50', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2814', '89', 'area', 'Size', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '5', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2815', '89', 'founded_value', 'Date of Foundation', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '6', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2816', '89', 'founded_type', 'The year age', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '7', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2817', '97', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2818', '97', 'name', 'image', '7', null, null, null, null, null, null, '0', '2', '1', '0', '1', '2', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2819', '97', 'id', '', '10', null, null, null, 'GeoPoi', 'geoNameImage', null, '0', '2', '0', '0', '1', '3', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2823', '98', 'typeId', 'Type', '30', 'poi_Types', 'id', null, null, null, 'CONCAT( poi_Types.treeItemName,\' - \',(SELECT name FROM poi_TypeTranslation WHERE poi_TypeTranslation.poiTypeId = poi_Types.id limit 1))  as name', '0', '1', '0', '0', '1', '2', '1', null, null, '200', null, null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('2824', '98', '99 as searchedViewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '4', '0', null, null, null, null, null, null, '0', '0', '1');
INSERT INTO `be_Fields` VALUES ('2829', '99', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2830', '99', 'typeId', 'Type (main)', '29', 'poi_Types', '', null, 'PoiTypesTree', '', '', '0', '3', '1', '0', '1', '2', '1', null, null, '200', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2831', '99', 'site', 'Web-site', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '60', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2832', '99', 'bookingUrl', 'bookingUrl', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '5', '1', null, null, '60', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2833', '99', 'id', 'Translations', '33', 'poi_ItemTranslation', 'poiId', 'id', null, null, null, '100', '1', '0', '0', '2', '1', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2834', '100', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2835', '100', 'langId', 'Language', '30', 'be_Languages', 'id', null, null, null, 'be_Languages.code langcode', '0', '1', '1', '0', '1', '2', '1', '1', null, '50', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2836', '100', 'name', 'Name', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '3', '1', null, null, '90', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2837', '100', 'description', 'Description', '3', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '600', '300', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2838', '98', 'lastUpdate', 'Modification date', '4', '', null, null, null, null, null, '0', '3', '0', '0', '1', '3', '1', null, null, '20', null, null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('2839', '99', 'lastUpdate', 'Modification date', '4', '', null, null, null, null, null, '0', '2', '0', '0', '1', '6', '1', null, null, '20', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2840', '99', 'userId', 'User', '30', 'fe_Users', 'id', null, null, 'getUsers', 'fe_Users.name name', '0', '3', '0', '0', '1', '3', '1', null, null, '382', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2841', '99', 'stage', 'stage', '6', null, null, null, null, null, null, '0', '1', '0', '0', '1', '8', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2842', '99', 'importId', 'ID import', '1', '', '', null, null, null, '', '0', '0', '0', '0', '1', '7', '1', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2843', '99', 'id', 'Types', '10', '', '', '', 'GeoPoi', 'poiTypes', '', '0', '2', '0', '0', '3', '1', '1', null, '', '670', '400', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2844', '99', 'id', 'Location', '33', 'poi_Locations', 'poiId', 'id', null, null, null, '101', '1', '0', '0', '4', '1', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2845', '101', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2846', '101', 'cityId', 'City (transliteration of Cyrillic)', '30', 'fe_GeoNames', 'id', null, null, 'fe_GeoNames', 'fe_GeoNames.name name', '0', '3', '0', '0', '1', '2', '1', '', null, '300', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2847', '101', 'latitude', 'Latitude', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2848', '101', 'longitude', 'Longitude', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2849', '101', 'showOnMap', 'Show on the map', '6', null, null, null, null, null, null, '0', '1', '0', '0', '1', '5', '1', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2850', '101', 'showAddress', 'Show address', '6', null, null, null, null, null, null, '0', '1', '0', '0', '1', '6', '1', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2851', '101', 'metrics', 'Metric', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '7', '1', null, null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2857', '99', 'id', 'Photo', '33', 'be_PoiItemImages', 'objectId', 'id', null, null, null, '103', '1', '0', '0', '5', '1', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2858', '98', 'id', 'id', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '1', '1', null, null, '5', null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('2859', '102', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2860', '102', 'langId', 'Language', '30', 'be_Languages', 'id', null, null, null, 'be_Languages.code langcode', '0', '1', '1', '0', '1', '2', '1', '1', null, '50', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2861', '102', 'name', 'Name', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '3', '1', null, null, '90', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2862', '101', 'id', 'Translations', '33', 'poi_LocationTranslation', 'locationId', 'id', null, null, null, '102', '1', '0', '0', '1', '8', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2863', '103', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2864', '103', 'name', 'image', '7', null, null, null, null, null, null, '0', '2', '1', '0', '1', '2', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2865', '103', 'id', '', '10', null, null, null, 'GeoPoi', 'poiImage', null, '0', '2', '0', '0', '1', '3', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2866', '109', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '1', '0', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2867', '109', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '2', '0', '107', null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2868', '109', 'langId', 'Language', '13', null, null, null, null, null, null, '2', '1', '1', '0', '0', '3', '1', null, null, '100', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2869', '109', 'title', 'Header', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '4', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2870', '109', 'number1', 'The number of stories that you want to skip', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '5', '1', null, null, '3', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2871', '109', 'number2', 'The number of stories shown', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '6', '1', null, null, '3', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2872', '109', 'text3', 'List of news', '8', null, null, null, null, null, null, '1', '1', '1', '0', '0', '7', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2873', '109', 'number3', 'Associated ...', '30', 'be_ListItems', 'id', null, null, null, 'be_ListItems.listItemName', '0', '1', '1', '0', '1', '8', '1', null, null, '200', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2874', '99', 'id', 'Video', '33', 'poi_Videos', 'poiId', 'id', null, null, null, '104', '1', '0', '0', '6', '1', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2875', '104', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2876', '104', 'url', 'url', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '90', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2877', '104', 'id', 'Translations', '33', 'poi_VideoTranslation', 'videoId', 'id', null, null, null, '105', '1', '0', '0', '4', '1', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2878', '105', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2879', '105', 'langId', 'Language', '30', 'be_Languages', 'id', null, null, null, 'be_Languages.code langcode', '0', '1', '1', '0', '1', '2', '1', '1', null, '50', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2880', '105', 'title', 'Name', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '3', '1', null, null, '90', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2881', '105', 'description', 'Brief description', '2', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '60', '5', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2882', '105', 'author', 'Author', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '5', '1', null, null, '60', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2883', '105', 'authorUrl', 'Url of the author', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '6', '1', null, null, '90', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2885', '106', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2886', '106', 'code', 'Code', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2887', '106', 'number', 'Room', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2888', '106', 'id', 'Translations', '33', 'poi_PhoneTranslation', 'phoneId', 'id', null, null, null, '107', '1', '0', '0', '4', '1', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2889', '107', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2890', '107', 'langId', 'Language', '30', 'be_Languages', 'id', null, null, null, 'be_Languages.code langcode', '0', '1', '1', '0', '1', '2', '1', '1', null, '50', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2891', '107', 'description', 'Brief description', '2', null, null, null, null, null, null, '0', '1', '0', '0', '1', '3', '1', null, null, '60', '3', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2892', '98', 'name', 'Translation of the object', '11', '', '', null, 'GeoPoi', 'searchPoiByTranslation', '', '0', '1', '0', '0', '1', '1', '1', '', null, '100', '0', null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('2896', '89', 'id', 'Video', '33', 'be_GeoNameVideos', 'objectId', 'id', null, null, null, '133', '1', '0', '0', '4', '1', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2906', '101', 'id', 'Phones', '33', 'poi_Phones', 'locationId', 'id', null, null, null, '106', '1', '0', '0', '2', '1', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2907', '18', 'number1', 'Category', '30', 'be_ListItems', 'id', null, null, null, 'be_ListItems.listItemName', '0', '1', '0', '0', '1', '1', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2908', '11', 'listId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', '0', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2931', '85', 'shortDescription', 'Brief description', '2', null, null, null, null, null, null, '0', '1', '0', '0', '4', '1', '1', null, null, '50', '5', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2932', '85', 'text2', 'Ілюстраці', '7', null, '460x310_2', null, null, null, null, '0', '2', '0', '0', '3', '3', '1', null, null, '92', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2933', '85', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2934', '85', 'html', 'Full description(HTML)', '3', null, null, null, null, null, null, '0', '1', '1', '0', '4', '2', '1', null, null, '500', '100', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2935', '85', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2936', '85', 'langId', 'Language', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '3', '1', null, null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2937', '85', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '85', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2938', '85', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', '3', null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2939', '85', 'text1', 'Mini figure', '7', null, '65x65_1', null, null, null, null, '0', '2', '0', '0', '3', '2', '1', null, null, '92', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2940', '85', 'id', 'Page ID', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2941', '85', 'dateStartVisible', 'Date news', '4', null, null, null, null, null, null, '0', '2', '0', '0', '3', '1', '1', null, null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2942', '85', 'text3', 'Great illustration (578x345)', '7', null, null, null, null, null, null, '0', '1', '0', '0', '3', '4', '1', null, null, '92', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2943', '85', 'visible', 'Show news', '6', null, null, null, null, null, null, '0', '1', '0', '0', '1', '7', '1', '1', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2944', '85', 'text5', 'Video 570 x n', '7', null, null, null, null, null, null, '0', '1', '0', '0', '3', '7', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2945', '85', 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2946', '85', 'text6', 'Code to embed video 570 x n', '2', null, null, null, null, null, null, '0', '1', '0', '0', '3', '8', '1', null, null, '70', '4', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2947', '85', 'text7', 'The name of the video', '1', null, null, null, null, null, null, '0', '1', '0', '0', '3', '6', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2948', '85', 'id', 'Photo', '32', 'be_PageContent', 'pageId', 'contentId', 'fe_PagesRelatedItems', 'id', 'fe_PagesRelatedItems.title', '27', '3', '0', '0', '5', '3', '1', null, null, '610', '400', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2949', '85', 'text8', 'Photo gallery name', '1', null, null, null, null, null, null, '0', '1', '0', '0', '5', '1', '1', null, null, '97', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2950', '85', 'text9', 'Author', '1', null, null, null, null, null, null, '0', '1', '0', '0', '5', '2', '1', null, null, '97', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2951', '85', 'text10', 'Photo for list of media (150x85)', '7', null, null, null, null, null, null, '0', '1', '0', '0', '3', '5', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('2952', '85', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2953', '85', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2990', '86', 'introHtml', 'The introductory part', '3', null, null, null, null, null, null, '0', '1', '0', '0', '3', '3', '1', null, null, '650', '500', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2991', '86', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2992', '86', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '5', '0', '86', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2993', '86', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2994', '86', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2995', '86', 'id', 'Page ID', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '4', '0', null, null, '5', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2996', '86', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '86', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2997', '86', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '2', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2998', '86', 'langId', 'Language', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '1', '1', null, null, '100', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('2999', '86', 'number2', 'Number page', '1', null, null, null, null, null, null, '0', '1', '1', '0', '3', '2', '1', '5', null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3000', '86', 'seoTitle', 'SEO title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3072', '21', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3073', '21', 'html', 'Full description(HTML)', '3', null, null, null, null, null, null, '0', '1', '1', '0', '4', '2', '1', null, null, '500', '100', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3074', '21', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3075', '21', 'langId', 'Language', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '3', '1', null, null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3076', '21', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '21', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3077', '21', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', '3', null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3078', '21', 'id', 'Page ID', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3079', '21', 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3080', '21', 'id', 'Photo', '32', 'be_PageContent', 'pageId', 'contentId', 'fe_PagesRelatedItems', 'id', 'fe_PagesRelatedItems.title', '117', '3', '0', '0', '5', '3', '1', null, null, '610', '400', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3081', '21', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3084', '21', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3094', '87', 'shortDescription', 'Brief description', '2', null, null, null, null, null, null, '0', '1', '0', '0', '3', '1', '1', null, null, '50', '5', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3095', '87', 'html', 'Full description(HTML)', '3', null, null, null, null, null, null, '0', '1', '1', '0', '3', '2', '1', null, null, '500', '100', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3096', '87', 'langId', 'Language', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '3', '1', null, null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3097', '87', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '87', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3098', '87', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', '3', null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3099', '87', 'text1', 'Photo awards', '7', null, '65x65_1', null, null, null, null, '0', '2', '0', '0', '3', '2', '1', null, null, '92', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3100', '87', 'id', 'Page ID', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3101', '87', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3102', '87', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3104', '62', 'text1', 'template templates/./.tpl', '7', null, null, null, null, null, null, '0', '2', '1', '0', '5', '4', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3112', '55', 'isGag', 'Enable plug', '6', null, null, null, null, null, null, '0', '1', '0', '0', '6', '1', '1', '0', null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3113', '55', 'gagTitle', 'Page title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '6', '2', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3114', '55', 'gagHtml', 'Text page', '3', null, null, null, null, null, null, '0', '1', '0', '0', '6', '3', '1', null, null, '500', '100', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3115', '55', 'gagIPs', 'IP addresses (comma with a dot)', '2', null, null, null, null, null, null, '0', '1', '0', '0', '6', '4', '1', null, null, '40', '10', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3117', '117', 'shortDescription', 'Short description of the Input string)', '2', null, null, null, null, null, null, '0', '1', '0', '0', '0', '6', '1', null, null, '73', '5', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3118', '117', 'title', 'Name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '3', '1', null, null, '97', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3119', '117', 'text2', 'Phrase - slogan', '1', null, null, null, null, null, null, '0', '1', '0', '0', '0', '5', '1', null, null, '97', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3120', '88', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3121', '88', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '2', '0', '88', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3123', '88', 'langId', 'Language', '13', null, null, null, null, null, null, '2', '1', '1', '0', '0', '1', '1', null, null, '100', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3124', '88', 'title', 'Name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '3', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3125', '88', 'shortDescription', 'Text - description', '2', null, null, null, null, null, null, '0', '1', '0', '0', '0', '4', '1', null, null, '50', '3', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3139', '41', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', '0', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3140', '41', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3141', '41', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3142', '41', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '6', '1', null, null, '86', '0', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3143', '41', 'introHtml', 'Html', '3', null, null, null, null, null, null, '0', '1', '0', '0', '4', '1', '1', null, null, '60', '4', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3144', '41', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '41', null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3145', '41', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3146', '41', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '7', '1', null, null, '250', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3147', '41', 'langId', 'Language', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '3', '1', null, null, '100', '0', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3148', '41', 'text4', 'Mail site', '1', null, null, null, null, null, null, '0', '1', '0', '0', '3', '1', '1', null, null, '40', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3149', '41', 'text5', 'template templates/./.tpl', '7', null, null, null, null, null, null, '0', '2', '1', '0', '3', '5', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3150', '41', 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3151', '41', 'text1', 'Submitted data', '2', null, null, null, null, null, null, '0', '1', '0', '0', '3', '3', '1', null, null, '40', '10', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3172', '45', 'langId', 'Lang', '30', 'be_Languages', 'id', null, null, null, 'be_Languages.name', '0', '1', '0', '0', '1', '1', '1', null, null, '60', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3173', '45', 'title', 'Product title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '25', null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('3174', '45', 'categoryId', 'Category', '29', 'fe_ProductCategories', 'id', null, null, null, 'fe_ProductCategories.treeItemName', '0', '3', '0', '0', '1', '3', '1', '0', '1', '20', null, null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('3175', '45', 'viewId', 'Type', '30', 'be_View', 'viewId', null, null, null, 'be_View.name', '0', '1', '0', '0', '2', '8', '1', '46', null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3214', '17', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3215', '17', 'title', 'Category name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3216', '17', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', '17', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3217', '17', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3218', '17', 'treeItemName', 'Name in the menu', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3219', '17', 'rootId', '', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '7', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3220', '17', 'visible', 'Active', '6', null, null, null, null, null, null, '0', '1', '0', '0', '1', '8', '1', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3221', '17', 'number2', 'Number of products per page', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '9', '1', '20', null, '3', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3222', '17', 'id', 'Translations', '33', 'fe_ProductCategoryTranslations', 'categoryId', 'id', null, null, null, '42', '1', '1', '0', '2', '1', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3223', '30', 'number2', 'Directory Tree', '29', 'fe_ProductCategories', null, null, null, null, null, '17', '2', '1', '0', '0', '4', '1', '0', '0', null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3224', '30', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '1', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3225', '30', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '2', '0', '30', null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3226', '42', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3227', '42', 'langId', 'Language', '13', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', '1', null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3228', '42', 'title', 'Name', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '90', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3229', '42', 'categoryId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3230', '42', 'description', 'Description', '3', null, null, null, null, null, null, '0', '1', '0', '0', '1', '6', '1', null, null, '600', '200', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3231', '42', 'seoTitle', 'SEO title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '90', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3232', '42', 'seoDescription', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3233', '42', 'seoKeywords', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3234', '42', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title masterPageTitle', '0', '1', '0', '0', '1', '5', '1', '26', null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3236', '46', 'categoryId', 'Category', '29', 'fe_ProductCategories', 'id', null, null, null, 'fe_ProductCategories.treeItemName', '0', '3', '1', '0', '1', '5', '1', '0', '1', '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3237', '46', 'title', 'Product name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '90', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3238', '46', 'codeName', 'Url code', '12', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3239', '46', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '46', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3240', '46', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3241', '46', 'visible', 'Visible', '6', null, null, null, null, null, null, '0', '1', '0', '0', '1', '10', '1', '1', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3243', '46', 'price', 'Price', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '8', '1', '0.00', null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3244', '46', 'id', 'Translations', '33', 'fe_ProductTranslations', 'productId', 'id', null, null, null, '47', '1', '0', '0', '3', '1', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3245', '46', 'id', 'Variations', '33', 'fe_ProductVariations', 'productId', 'id', null, null, null, '48', '1', '0', '0', '4', '2', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3246', '47', 'seoKeywords', 'Seo keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3247', '47', 'html', 'Description', '3', null, null, null, null, null, null, '0', '1', '0', '0', '1', '7', '1', null, null, '500', '100', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3248', '47', 'seoDescription', 'Seo description', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3249', '47', 'masterPageId', 'Master Page', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title masterPageTitle', '0', '1', '0', '0', '1', '6', '1', '19', null, '200', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3250', '47', 'seoTitle', 'SEO title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3251', '47', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3252', '47', 'langId', 'Language', '13', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', '1', null, null, null, null, null, '0', '0', '1');
INSERT INTO `be_Fields` VALUES ('3253', '47', 'title', 'Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '90', null, null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('3255', '47', 'productId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3256', '48', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3257', '48', 'productId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '4', '0', null, null, null, null, null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('3260', '48', 'stock', 'Quantity', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '7', '1', null, null, '90', null, null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('3263', '46', 'oldPrice', 'Old price', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '7', '1', '0.00', null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3265', '46', 'itemNumber', 'Item number', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '6', '1', null, null, '41', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3266', '46', 'number3', 'Quantity', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '9', '0', '1', null, '10', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3268', '37', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3269', '37', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3270', '37', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3271', '37', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3273', '37', 'viewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '37', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3274', '37', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3275', '37', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3276', '37', 'langId', 'Language', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '3', '1', null, null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3282', '44', 'langId', 'Lang', '30', 'be_Languages', 'id', null, null, null, 'be_Languages.name', '0', '1', '0', '0', '1', '1', '1', null, null, '60', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3283', '44', 'title', 'Attribute title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '25', null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('3284', '44', 'viewId', 'Type', '30', 'be_View', 'viewId', null, null, null, 'be_View.name', '0', '1', '0', '0', '2', '8', '1', '46', null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3295', '49', 'title', 'Attribute name', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '90', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3297', '49', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3298', '49', 'id', 'Translations', '33', 'fe_ProductAttributeTranslations', 'attributeId', 'id', null, null, null, '50', '1', '1', '0', '2', '1', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3299', '49', 'id', 'Values', '33', 'fe_ProductAttributeItems', 'attributeId', 'id', null, null, null, '51', '1', '1', '0', '1', '4', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3300', '50', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3301', '50', 'langId', 'Language', '13', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', '1', null, null, null, null, null, '0', '0', '1');
INSERT INTO `be_Fields` VALUES ('3302', '50', 'title', 'Title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '90', null, null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('3303', '50', 'attributeId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, null, null, null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('3304', '52', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3305', '52', 'langId', 'Language', '13', null, null, null, null, null, null, '0', '1', '1', '0', '1', '2', '1', '1', null, null, null, null, null, '0', '0', '1');
INSERT INTO `be_Fields` VALUES ('3306', '52', 'title', 'Title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '90', null, null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('3307', '52', 'attributeItemId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '4', '0', null, null, null, null, null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('3308', '51', 'id', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3309', '51', 'title', 'Title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '2', '1', null, null, '30', null, null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('3310', '51', 'attributeId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '4', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3311', '51', 'id', 'Translations', '33', 'fe_ProductAttributeItemTranslations', 'attributeItemId', 'id', null, null, null, '52', '1', '0', '0', '1', '4', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3312', '44', '49 as searchedViewId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '4', '0', null, null, null, null, null, null, '0', '0', '1');
INSERT INTO `be_Fields` VALUES ('3313', '48', 'attribute1ValueId', 'Size', '30', 'fe_ProductAttributeItems prAttr1', 'id', null, null, null, 'prAttr1.title attribute1Title', '0', '1', '1', '0', '1', '2', '1', null, null, '200', null, null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('3314', '48', 'attribute2ValueId', 'Color', '30', 'fe_ProductAttributeItems prAttr2', 'id', null, null, null, 'prAttr2.title attribute2Title', '0', '1', '1', '0', '1', '3', '1', null, null, '200', null, null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('3315', '46', 'id', '', '10', null, null, null, 'ProductVariations', 'genProductVariations', '46_id_Variations[&]', '0', '2', '0', '0', '4', '1', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3316', '46', 'number1', 'Brand', '30', 'be_ListItems', 'id', null, null, null, 'be_ListItems.listItemName', '0', '1', '1', '0', '1', '5', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3318', '51', 'colorCode', 'Code', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '3', '1', null, null, '30', null, null, null, '0', '0', '1');
INSERT INTO `be_Fields` VALUES ('3319', '39', 'number1', 'Search in products', '6', null, null, null, null, null, null, '0', '1', '0', '0', '3', '1', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3321', '39', 'number2', 'Count on page', '1', null, null, null, null, null, null, '0', '1', '1', '0', '3', '2', '1', null, null, '10', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3323', '46', 'id', 'Photo', '33', 'fe_ProductImages', 'productId', 'id', '', 'orderNr', '', '57', '1', '0', '0', '2', '1', '1', null, null, '670', '200', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3336', '57', 'id', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '3', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3339', '57', 'imageSmall', 'Small image', '7', null, '231x348', null, null, null, null, '0', '2', '1', '0', '1', '5', '1', null, null, '92', null, null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('3340', '57', 'image', 'Normal image', '7', null, '401x604', null, null, null, null, '0', '2', '1', '0', '1', '6', '1', '', null, '92', '0', null, null, null, '0', '1');
INSERT INTO `be_Fields` VALUES ('3341', '57', 'viewId', null, '1', null, null, null, null, null, null, '0', '0', '1', '0', '1', '1', '0', '57', null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3342', '57', 'productId', '', '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3347', '37', 'shortDescription', 'Success registration text', '2', null, null, null, null, null, null, '0', '1', '1', '0', '3', '5', '1', null, null, '69', '3', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3348', '37', 'text3', 'Success registration confirmation', '2', null, null, null, null, null, null, '0', '1', '1', '0', '3', '6', '1', null, null, '69', '3', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3349', '37', 'text4', 'Error registration confirmation', '2', null, null, null, null, null, null, '0', '1', '1', '0', '3', '7', '1', null, null, '69', '3', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3350', '133', 'id', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3351', '133', 'viewId', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '2', '0', '133', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3352', '133', 'langId', 'Language', '13', null, null, null, null, null, null, '2', '1', '1', '0', '0', '1', '1', null, null, '100', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3353', '133', 'title', 'Title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '0', '3', '1', null, null, '40', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3354', '134', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3355', '134', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3356', '134', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3357', '134', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3358', '134', 'viewId', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '134', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3359', '134', 'id', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3360', '134', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3361', '134', 'langId', 'Language', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '3', '1', null, null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3362', '134', 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3363', '135', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3364', '135', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3365', '135', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3366', '135', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3367', '135', 'viewId', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '135', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3368', '135', 'id', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3369', '135', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3370', '135', 'langId', 'Language', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '3', '1', null, null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3371', '135', 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3372', '136', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3373', '136', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3374', '136', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3375', '136', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3376', '136', 'viewId', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '136', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3377', '136', 'id', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3378', '136', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3379', '136', 'langId', 'Language', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '3', '1', null, null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3380', '136', 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3390', '138', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3391', '138', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3392', '138', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3393', '138', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3394', '138', 'viewId', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '138', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3395', '138', 'id', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3396', '138', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3397', '138', 'langId', 'Language', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '3', '1', null, null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3398', '138', 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3399', '138', 'introHtml', 'Text', '3', null, null, null, null, null, null, '0', '1', '1', '0', '1', '7', '1', null, null, '100', '50', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3400', '38', 'id', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3401', '38', 'langId', 'Мова', '30', 'be_Languages', 'id', null, null, null, 'be_Languages.code langcode', '0', '1', '1', '0', '1', '3', '1', '1', null, '50', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3402', '38', 'name', 'Назва', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, '90', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3403', '38', 'listItemId', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3404', '47', 'material', 'Material', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '5', '1', null, null, '90', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3405', '9', 'openLinkInNewWindow', 'Open in new window', '6', null, null, null, null, null, null, '0', '1', '0', '0', '0', '7', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3431', '70', 'id', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, 'mailTemplateId', null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3432', '70', 'title', 'Ім\'я', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3433', '70', 'body', 'Текст листа', '3', null, null, null, null, null, null, '0', '1', '1', '0', '1', '7', '1', null, null, '400', '300', 'eventBody', null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3434', '70', 'id', 'Подія', '10', null, null, null, 'EventField', 'eventList', null, '0', '2', '0', '0', '1', '8', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3435', '70', 'emails', 'Кому (дані вводити через ,)', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '5', '1', null, null, '95', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3436', '70', 'cc', 'Копія', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '6', '0', null, null, '100', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3437', '70', 'active', 'Активний', '6', null, null, null, null, null, null, '0', '1', '0', '0', '1', '9', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3438', '70', 'seeAddresses', 'Показати всі адреси в листі', '6', null, null, null, null, null, null, '0', '1', '0', '0', '1', '10', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3439', '70', 'langId', 'Мова', '13', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', '1', null, '100', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3440', '70', 'subject', 'Тема листа', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '4', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3441', '70', 'userId', 'Користувач\r\nпошук по масці: email або прізвище', '30', 'fe_Users', 'id', null, null, 'getUsers', 'CONCAT(fe_Users.email,\' \',IFNULL(fe_Users.name,\'\'),\' \',IFNULL(fe_Users.surname,\'\')) username', '0', '3', '0', '0', '2', '1', '1', null, null, '200', null, 'eventUser', null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3443', '70', 'id', 'Тестовий Email', '10', null, null, null, 'EventField', 'testSend', null, '0', '2', '0', '0', '2', '3', '1', null, null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3444', '70', 'bcc', 'Email адміністратора (прихована копія)', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '6', '1', null, null, '95', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3453', '137', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3454', '137', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3455', '137', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3456', '137', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3457', '137', 'viewId', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '137', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3458', '137', 'id', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3459', '137', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3460', '137', 'langId', 'Language', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '3', '1', null, null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3461', '137', 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3462', '71', 'title', 'Ім\'я', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '2', '1', null, null, null, null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('3463', '71', 'eventId', 'Подія', '30', 'be_Events', 'id', null, null, null, 'be_Events.name', '0', '1', '0', '0', '1', '3', '1', null, null, null, null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('3464', '71', 'langId', 'Мова', '30', 'be_Languages', 'id', null, null, null, 'be_Languages.code langcode', '0', '1', '0', '0', '1', '1', '1', null, null, '50', null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('3465', '71', '70 as searchedViewId', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '4', '0', null, null, null, null, null, null, '0', '0', '1');
INSERT INTO `be_Fields` VALUES ('3468', '139', 'title', 'Назва', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '1', '1', null, null, '25', null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('3469', '139', '140 as searchedViewId', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, '0', '0', '1');
INSERT INTO `be_Fields` VALUES ('3470', '140', 'id', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3471', '140', 'title', 'Назва', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '2', '1', null, null, '25', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3472', '140', 'merchantId', 'Merchant ID', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '25', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3473', '140', 'secretKey', 'Секретний ключ', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '25', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3474', '140', 'hiddenKey', 'Прихований ключ', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '25', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3475', '140', 'apiKey', 'Ключ API', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '6', '1', null, null, '25', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3476', '140', 'successUrl', 'Success URL', '8', null, null, null, null, null, null, '1', '1', '1', '0', '1', '7', '1', null, null, '85', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3477', '140', 'failUrl', 'Fail URL', '8', null, null, null, null, null, null, '1', '1', '1', '0', '1', '8', '1', null, null, '85', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3478', '140', 'resultUrl', 'Result URL', '8', null, null, null, null, null, null, '1', '1', '1', '0', '1', '9', '1', null, null, '85', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3479', '140', 'currencyId', 'Валюта', '30', 'be_ListItems', 'id', null, null, null, 'be_ListItems.listItemName', '0', '1', '1', '0', '1', '6', '1', '', null, null, null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3480', '141', 'title', 'Page title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3481', '141', 'seo2', 'Keywords', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3482', '141', 'seo1', 'Description of the page', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3483', '141', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3484', '141', 'viewId', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '141', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3485', '141', 'id', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3486', '141', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3487', '141', 'langId', 'Language', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '3', '1', null, null, '100', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3488', '141', 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3490', '33', 'text3', 'Cancel button link', '8', null, null, null, null, null, null, '1', '1', '1', '0', '2', '4', '1', null, null, '92', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3491', '141', 'introHtml', 'Text', '3', null, null, null, null, null, null, '0', '1', '1', '0', '1', '7', '1', null, null, '100', '50', null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3492', '142', 'introHtml', 'The introductory part', '3', null, null, null, null, null, null, '0', '1', '0', '0', '1', '7', '1', null, null, '650', '500', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3493', '142', 'viewId', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', '142', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3494', '142', 'id', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3495', '142', 'masterPageId', 'Template wizard', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '4', '1', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3496', '142', 'langId', 'Language', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '3', '1', null, null, null, '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3497', '142', 'codeName', 'Code page', '12', null, null, null, null, null, null, '0', '1', '1', '0', '1', '6', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3498', '142', 'title', 'Title', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3499', '57', 'imageBig', 'Big image', '7', null, '800x1200', null, null, null, null, '0', '2', '1', '0', '1', '7', '1', 'ImAGe', null, '92', null, null, null, '0', '0', '1');
INSERT INTO `be_Fields` VALUES ('3514', '65', 'id', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3515', '65', 'viewId', null, '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', '65', null, '5', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3516', '65', 'orderId', 'Order number', '1', null, null, null, null, null, null, '0', '1', '0', '0', '1', '1', '1', null, null, '20', null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('3517', '65', 'orderStatusId', 'Order status', '30', 'fe_OrderStatus', 'id', null, null, null, 'fe_OrderStatus.description orderStatus', '0', '1', '1', '0', '1', '4', '1', '1', null, null, null, null, null, '0', '1', '1');
INSERT INTO `be_Fields` VALUES ('3518', '65', 'orderStatusId', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '6', '0', null, null, null, null, null, null, '0', '0', '1');
INSERT INTO `be_Fields` VALUES ('3519', '65', 'createDate', 'Order date', '4', null, null, null, null, null, null, '0', '3', '0', '0', '1', '8', '1', null, null, null, null, null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('3520', '65', 'userId', 'Customer', '30', 'fe_Users', 'id', null, null, 'getUsers', 'concat(fe_Users.name,\' \',fe_Users.surname,\' \',fe_Users.email) userData', '0', '3', '0', '0', '1', '7', '1', null, null, '340', null, null, null, null, '1', '1');
INSERT INTO `be_Fields` VALUES ('3521', '66', 'id', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3522', '66', 'viewId', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', '66', null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3523', '66', 'orderId', 'Order number', '1', null, null, null, null, null, null, '0', '0', '1', '0', '1', '3', '1', null, null, '20', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3524', '66', 'orderStatusId', 'Order status', '30', 'fe_OrderStatus', 'id', null, null, null, 'fe_OrderStatus.description', '0', '4', '0', '0', '1', '4', '1', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3525', '66', 'userId', 'Customer', '30', 'fe_Users', 'id', null, null, 'getUsers', 'concat(fe_Users.name,\' \',fe_Users.surname,\' \',fe_Users.email) userData', '0', '3', '0', '0', '1', '5', '1', null, null, '340', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3526', '66', 'createDate', 'Order date', '4', null, null, null, null, null, null, '0', '2', '0', '0', '1', '6', '1', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3527', '66', 'updateDate', 'Last updates', '4', null, null, null, null, null, null, '0', '2', '0', '0', '1', '7', '1', null, null, null, null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3528', '66', 'orderPrice', 'Price', '1', null, null, null, null, null, null, '0', '0', '1', '0', '2', '8', '1', '0.00', null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3529', '66', 'deliveryPrice', 'Delivery price', '1', null, null, null, null, null, null, '0', '0', '1', '0', '2', '9', '1', '0.00', null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3530', '66', 'totalPrice', 'Total price', '1', null, null, null, null, null, null, '0', '0', '1', '0', '2', '10', '1', '0.00', null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3531', '66', 'paymentStatusId', 'Payment status', '30', 'fe_PaymentStatus', 'id', null, null, null, 'fe_PaymentStatus.description paymentStatus', '0', '4', '0', '0', '2', '12', '1', null, null, '20', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3532', '66', 'paymentMethodId', 'Payment method', '30', 'fe_PaymentMethods', 'id', null, null, null, 'fe_PaymentMethods.title paymentMethod', '0', '4', '0', '0', '2', '13', '1', null, null, '20', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3533', '66', 'itemsCount', 'Items count', '1', null, null, null, null, null, null, '0', '0', '1', '0', '2', '11', '1', '0.00', null, '10', null, null, null, null, '0', '0');
INSERT INTO `be_Fields` VALUES ('3534', '66', 'id', 'History', '10', null, null, null, 'Shop', 'orderHistory', null, '0', '1', '0', '0', '3', '1', '1', null, null, '670', null, null, null, '0', '0', '0');
INSERT INTO `be_Fields` VALUES ('3535', '66', 'note', 'Note', '2', null, null, null, null, null, null, '0', '1', '0', '0', '1', '8', '1', null, null, '40', '3', null, null, '0', '0', '0');

-- ----------------------------
-- Table structure for `be_FieldTypes`
-- ----------------------------
DROP TABLE IF EXISTS `be_FieldTypes`;
CREATE TABLE `be_FieldTypes` (
  `FieldTypeId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `templateName` varchar(255) NOT NULL,
  PRIMARY KEY (`FieldTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of be_FieldTypes
-- ----------------------------
INSERT INTO `be_FieldTypes` VALUES ('1', 'text', 'Simple text field', '');
INSERT INTO `be_FieldTypes` VALUES ('2', 'textarea', 'textarea', '');
INSERT INTO `be_FieldTypes` VALUES ('3', 'fckeditor', 'FCKEditor', '');
INSERT INTO `be_FieldTypes` VALUES ('4', 'date', 'text field for date input', '');
INSERT INTO `be_FieldTypes` VALUES ('5', 'radiobutton', 'Radio button', '');
INSERT INTO `be_FieldTypes` VALUES ('6', 'checkbox', 'check box for 1or 0', '');
INSERT INTO `be_FieldTypes` VALUES ('7', 'file', 'Input type file', '');
INSERT INTO `be_FieldTypes` VALUES ('8', 'link', 'Links to content page or another site', '');
INSERT INTO `be_FieldTypes` VALUES ('9', 'internalPage', 'Return ID of searched page. This field is alternative of mpselectbox and used for saving related contennt without be_PageContent', '');
INSERT INTO `be_FieldTypes` VALUES ('10', 'customField', 'customField', '');
INSERT INTO `be_FieldTypes` VALUES ('11', 'custom field for search', '', '');
INSERT INTO `be_FieldTypes` VALUES ('12', 'page code field type', 'custom field type for page code', '');
INSERT INTO `be_FieldTypes` VALUES ('13', 'multilang', 'multilanguage field type', '');
INSERT INTO `be_FieldTypes` VALUES ('29', 'tree', 'DHTML Tree', '');
INSERT INTO `be_FieldTypes` VALUES ('30', 'listbox', 'Drop down select box', '');
INSERT INTO `be_FieldTypes` VALUES ('31', 'mpselectbox', 'Multiply select box', '');
INSERT INTO `be_FieldTypes` VALUES ('32', 'complexManyToMany', 'New complex field for some reasoms', '');
INSERT INTO `be_FieldTypes` VALUES ('33', 'complexManyToOne', 'New complex field for relation many-to-one . (See example in tables List and ListItems)', '');

-- ----------------------------
-- Table structure for `be_Group`
-- ----------------------------
DROP TABLE IF EXISTS `be_Group`;
CREATE TABLE `be_Group` (
  `viewId` int(11) unsigned NOT NULL DEFAULT '0',
  `groupId` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `groupName` char(200) NOT NULL,
  PRIMARY KEY (`viewId`,`groupId`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of be_Group
-- ----------------------------
INSERT INTO `be_Group` VALUES ('0', '54', 'Main');
INSERT INTO `be_Group` VALUES ('1', '1', 'Search on main fields of the');
INSERT INTO `be_Group` VALUES ('2', '1', 'Search');
INSERT INTO `be_Group` VALUES ('2', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('2', '3', 'Content');
INSERT INTO `be_Group` VALUES ('3', '1', 'Search lists');
INSERT INTO `be_Group` VALUES ('5', '1', 'Total');
INSERT INTO `be_Group` VALUES ('7', '1', 'Navigation tree');
INSERT INTO `be_Group` VALUES ('7', '2', 'Basic information');
INSERT INTO `be_Group` VALUES ('8', '1', 'Basic information');
INSERT INTO `be_Group` VALUES ('8', '2', 'Navigation tree');
INSERT INTO `be_Group` VALUES ('12', '1', 'System information');
INSERT INTO `be_Group` VALUES ('12', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('12', '3', 'Detailed description');
INSERT INTO `be_Group` VALUES ('13', '1', 'General information');
INSERT INTO `be_Group` VALUES ('13', '2', 'Top');
INSERT INTO `be_Group` VALUES ('13', '3', 'Left');
INSERT INTO `be_Group` VALUES ('13', '4', 'Right');
INSERT INTO `be_Group` VALUES ('13', '5', 'Bottom');
INSERT INTO `be_Group` VALUES ('17', '1', 'System information');
INSERT INTO `be_Group` VALUES ('17', '2', 'Translations');
INSERT INTO `be_Group` VALUES ('18', '1', 'System information');
INSERT INTO `be_Group` VALUES ('18', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('18', '3', 'Content');
INSERT INTO `be_Group` VALUES ('18', '4', 'Description');
INSERT INTO `be_Group` VALUES ('18', '5', 'Photo');
INSERT INTO `be_Group` VALUES ('19', '1', 'System information');
INSERT INTO `be_Group` VALUES ('19', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('19', '3', 'General information');
INSERT INTO `be_Group` VALUES ('21', '1', 'System information');
INSERT INTO `be_Group` VALUES ('21', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('21', '4', 'Description');
INSERT INTO `be_Group` VALUES ('21', '5', 'Photo');
INSERT INTO `be_Group` VALUES ('22', '1', 'The first Taba');
INSERT INTO `be_Group` VALUES ('22', '2', 'The second Taba');
INSERT INTO `be_Group` VALUES ('25', '1', 'System information');
INSERT INTO `be_Group` VALUES ('25', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('25', '3', 'General information');
INSERT INTO `be_Group` VALUES ('26', '1', 'System information');
INSERT INTO `be_Group` VALUES ('26', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('26', '3', 'Content');
INSERT INTO `be_Group` VALUES ('26', '4', 'Pictures');
INSERT INTO `be_Group` VALUES ('28', '1', 'Search lists');
INSERT INTO `be_Group` VALUES ('31', '1', 'Search on main fields of the');
INSERT INTO `be_Group` VALUES ('32', '1', 'System information');
INSERT INTO `be_Group` VALUES ('32', '2', 'Accessible sites');
INSERT INTO `be_Group` VALUES ('33', '1', 'System information');
INSERT INTO `be_Group` VALUES ('33', '2', 'Content page');
INSERT INTO `be_Group` VALUES ('34', '1', 'Basic data');
INSERT INTO `be_Group` VALUES ('34', '2', 'Content');
INSERT INTO `be_Group` VALUES ('35', '1', 'Search on main fields of the');
INSERT INTO `be_Group` VALUES ('36', '1', 'System information');
INSERT INTO `be_Group` VALUES ('36', '2', 'Jur. information');
INSERT INTO `be_Group` VALUES ('37', '1', 'System information');
INSERT INTO `be_Group` VALUES ('37', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('37', '3', 'Detailed description');
INSERT INTO `be_Group` VALUES ('39', '1', 'System information');
INSERT INTO `be_Group` VALUES ('39', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('39', '3', 'Detailed description');
INSERT INTO `be_Group` VALUES ('41', '1', 'System information');
INSERT INTO `be_Group` VALUES ('41', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('41', '3', 'Detailed description');
INSERT INTO `be_Group` VALUES ('41', '4', 'Html');
INSERT INTO `be_Group` VALUES ('42', '1', 'General information');
INSERT INTO `be_Group` VALUES ('42', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('45', '1', 'Search products');
INSERT INTO `be_Group` VALUES ('45', '2', 'Junk');
INSERT INTO `be_Group` VALUES ('46', '1', 'System information');
INSERT INTO `be_Group` VALUES ('46', '2', 'Content');
INSERT INTO `be_Group` VALUES ('46', '3', 'Translations');
INSERT INTO `be_Group` VALUES ('46', '4', 'Variations');
INSERT INTO `be_Group` VALUES ('47', '1', 'General information');
INSERT INTO `be_Group` VALUES ('47', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('49', '1', 'System information');
INSERT INTO `be_Group` VALUES ('49', '2', 'Translations');
INSERT INTO `be_Group` VALUES ('50', '1', 'General information');
INSERT INTO `be_Group` VALUES ('51', '1', 'General information');
INSERT INTO `be_Group` VALUES ('52', '1', 'General information');
INSERT INTO `be_Group` VALUES ('54', '1', 'Basic data');
INSERT INTO `be_Group` VALUES ('55', '1', 'general');
INSERT INTO `be_Group` VALUES ('55', '2', 'Mail settings');
INSERT INTO `be_Group` VALUES ('55', '3', 'Additional');
INSERT INTO `be_Group` VALUES ('55', '4', 'Site languages');
INSERT INTO `be_Group` VALUES ('55', '5', 'Image processing');
INSERT INTO `be_Group` VALUES ('55', '6', 'Blind stopper');
INSERT INTO `be_Group` VALUES ('56', '1', 'Total');
INSERT INTO `be_Group` VALUES ('60', '1', 'List Of Languages');
INSERT INTO `be_Group` VALUES ('62', '1', 'System information');
INSERT INTO `be_Group` VALUES ('63', '1', 'general');
INSERT INTO `be_Group` VALUES ('65', '1', 'System information');
INSERT INTO `be_Group` VALUES ('66', '1', 'System information');
INSERT INTO `be_Group` VALUES ('66', '2', 'Order details');
INSERT INTO `be_Group` VALUES ('66', '3', 'History');
INSERT INTO `be_Group` VALUES ('70', '1', 'Основні дані');
INSERT INTO `be_Group` VALUES ('70', '2', 'Тестова відправка');
INSERT INTO `be_Group` VALUES ('75', '1', 'System information');
INSERT INTO `be_Group` VALUES ('75', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('75', '3', 'Detailed description');
INSERT INTO `be_Group` VALUES ('75', '4', 'Additionally');
INSERT INTO `be_Group` VALUES ('76', '1', 'System information');
INSERT INTO `be_Group` VALUES ('76', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('76', '3', 'Successful registration');
INSERT INTO `be_Group` VALUES ('76', '4', 'Error');
INSERT INTO `be_Group` VALUES ('76', '5', 'Additional description');
INSERT INTO `be_Group` VALUES ('77', '1', 'System information');
INSERT INTO `be_Group` VALUES ('77', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('77', '3', 'Detailed description');
INSERT INTO `be_Group` VALUES ('77', '4', 'Results page');
INSERT INTO `be_Group` VALUES ('79', '1', 'Syst. information');
INSERT INTO `be_Group` VALUES ('79', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('79', '3', 'Content');
INSERT INTO `be_Group` VALUES ('79', '4', 'Tickets/services');
INSERT INTO `be_Group` VALUES ('79', '5', 'Related products');
INSERT INTO `be_Group` VALUES ('79', '6', 'Text');
INSERT INTO `be_Group` VALUES ('79', '7', 'Application');
INSERT INTO `be_Group` VALUES ('83', '1', 'System information');
INSERT INTO `be_Group` VALUES ('83', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('83', '3', 'Detailed description');
INSERT INTO `be_Group` VALUES ('84', '1', 'System information');
INSERT INTO `be_Group` VALUES ('84', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('84', '3', 'Detailed description');
INSERT INTO `be_Group` VALUES ('85', '1', 'System information');
INSERT INTO `be_Group` VALUES ('85', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('85', '3', 'Content');
INSERT INTO `be_Group` VALUES ('85', '4', 'Description');
INSERT INTO `be_Group` VALUES ('85', '5', 'Photo');
INSERT INTO `be_Group` VALUES ('86', '1', 'System information');
INSERT INTO `be_Group` VALUES ('86', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('86', '3', 'General information');
INSERT INTO `be_Group` VALUES ('87', '1', 'General information');
INSERT INTO `be_Group` VALUES ('87', '3', 'Additional information');
INSERT INTO `be_Group` VALUES ('89', '1', 'System information');
INSERT INTO `be_Group` VALUES ('89', '2', 'Translations');
INSERT INTO `be_Group` VALUES ('89', '3', 'Photo');
INSERT INTO `be_Group` VALUES ('89', '4', 'Video');
INSERT INTO `be_Group` VALUES ('91', '1', 'Search types адмін.ділень');
INSERT INTO `be_Group` VALUES ('92', '1', 'System information');
INSERT INTO `be_Group` VALUES ('92', '2', 'Translations');
INSERT INTO `be_Group` VALUES ('95', '1', 'System information');
INSERT INTO `be_Group` VALUES ('95', '2', 'Translations');
INSERT INTO `be_Group` VALUES ('97', '1', 'general');
INSERT INTO `be_Group` VALUES ('98', '1', 'The Poi-objects');
INSERT INTO `be_Group` VALUES ('99', '1', 'System information');
INSERT INTO `be_Group` VALUES ('99', '2', 'Translations');
INSERT INTO `be_Group` VALUES ('99', '3', 'Object types');
INSERT INTO `be_Group` VALUES ('99', '4', 'Location');
INSERT INTO `be_Group` VALUES ('99', '5', 'Photo');
INSERT INTO `be_Group` VALUES ('99', '6', 'Video');
INSERT INTO `be_Group` VALUES ('101', '1', 'Basic information');
INSERT INTO `be_Group` VALUES ('101', '2', 'Phones');
INSERT INTO `be_Group` VALUES ('103', '1', 'general');
INSERT INTO `be_Group` VALUES ('108', '1', 'System information');
INSERT INTO `be_Group` VALUES ('108', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('108', '3', 'Detailed description');
INSERT INTO `be_Group` VALUES ('114', '1', 'Search lists');
INSERT INTO `be_Group` VALUES ('116', '1', 'System information');
INSERT INTO `be_Group` VALUES ('116', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('116', '3', 'Detailed description');
INSERT INTO `be_Group` VALUES ('120', '1', 'General information');
INSERT INTO `be_Group` VALUES ('121', '1', 'System information');
INSERT INTO `be_Group` VALUES ('122', '1', 'System information');
INSERT INTO `be_Group` VALUES ('122', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('123', '1', 'System information');
INSERT INTO `be_Group` VALUES ('124', '1', 'Basic data');
INSERT INTO `be_Group` VALUES ('125', '1', 'System information');
INSERT INTO `be_Group` VALUES ('125', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('125', '3', 'Settings');
INSERT INTO `be_Group` VALUES ('127', '1', 'System information');
INSERT INTO `be_Group` VALUES ('127', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('127', '3', 'Content');
INSERT INTO `be_Group` VALUES ('128', '1', 'System information');
INSERT INTO `be_Group` VALUES ('128', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('128', '3', 'General information');
INSERT INTO `be_Group` VALUES ('130', '1', 'System information');
INSERT INTO `be_Group` VALUES ('131', '1', 'Basic data');
INSERT INTO `be_Group` VALUES ('132', '1', 'general');
INSERT INTO `be_Group` VALUES ('134', '1', 'System information');
INSERT INTO `be_Group` VALUES ('134', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('135', '1', 'System information');
INSERT INTO `be_Group` VALUES ('135', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('136', '1', 'System information');
INSERT INTO `be_Group` VALUES ('136', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('137', '1', 'System information');
INSERT INTO `be_Group` VALUES ('137', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('138', '1', 'System information');
INSERT INTO `be_Group` VALUES ('138', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('139', '1', 'Пошук по головним полям');
INSERT INTO `be_Group` VALUES ('140', '1', 'Інформація');
INSERT INTO `be_Group` VALUES ('141', '1', 'System information');
INSERT INTO `be_Group` VALUES ('141', '2', 'META tags');
INSERT INTO `be_Group` VALUES ('142', '1', 'System information');

-- ----------------------------
-- Table structure for `be_ImageDescription`
-- ----------------------------
DROP TABLE IF EXISTS `be_ImageDescription`;
CREATE TABLE `be_ImageDescription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `viewId` int(11) DEFAULT NULL,
  `imageId` int(11) NOT NULL DEFAULT '0',
  `langId` int(2) unsigned NOT NULL DEFAULT '0',
  `objectName` varchar(255) DEFAULT NULL,
  `workName` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `authorUrl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_image_imageDescription` (`imageId`),
  CONSTRAINT `fk_image_imageDescription` FOREIGN KEY (`imageId`) REFERENCES `be_Images` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of be_ImageDescription
-- ----------------------------

-- ----------------------------
-- Table structure for `be_Images`
-- ----------------------------
DROP TABLE IF EXISTS `be_Images`;
CREATE TABLE `be_Images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `viewId` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `waterMarkId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_Images
-- ----------------------------

-- ----------------------------
-- Table structure for `be_ImageSizeRelations`
-- ----------------------------
DROP TABLE IF EXISTS `be_ImageSizeRelations`;
CREATE TABLE `be_ImageSizeRelations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imageId` int(11) DEFAULT NULL,
  `sizeCode` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_image_imageSizeRelation` (`imageId`),
  CONSTRAINT `fk_image_imageSizeRelation` FOREIGN KEY (`imageId`) REFERENCES `be_Images` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_ImageSizeRelations
-- ----------------------------

-- ----------------------------
-- Table structure for `be_ImageSizes`
-- ----------------------------
DROP TABLE IF EXISTS `be_ImageSizes`;
CREATE TABLE `be_ImageSizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `viewId` int(11) DEFAULT NULL,
  `imageSizeCode` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `folderName` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `useWatermark` int(2) unsigned NOT NULL DEFAULT '0',
  `isProportion` int(2) unsigned NOT NULL DEFAULT '1',
  `websiteId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ImageSizes_Website` (`websiteId`),
  CONSTRAINT `fk_ImageSizes_Website` FOREIGN KEY (`websiteId`) REFERENCES `be_WebSites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_ImageSizes
-- ----------------------------
INSERT INTO `be_ImageSizes` VALUES ('6', '63', '231x348', 'photo_product(231x348)', 'photo_product', '231', '348', '0', '0', '1');
INSERT INTO `be_ImageSizes` VALUES ('7', '63', '401x604', 'photo_product(401x604)', 'photo_product', '401', '604', '0', '0', '1');
INSERT INTO `be_ImageSizes` VALUES ('8', '63', '800x1200', 'photo_product(800x1200)', 'photo_product', '800', '1200', '0', '0', '1');

-- ----------------------------
-- Table structure for `be_Languages`
-- ----------------------------
DROP TABLE IF EXISTS `be_Languages`;
CREATE TABLE `be_Languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(6) DEFAULT NULL,
  `masterpageid` int(10) unsigned DEFAULT NULL,
  `metatag` varchar(10) DEFAULT NULL,
  `priority` int(10) unsigned DEFAULT NULL,
  `viewId` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `langImage` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_view_languages` (`viewId`),
  CONSTRAINT `fk_view_languages` FOREIGN KEY (`viewId`) REFERENCES `be_View` (`viewId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of be_Languages
-- ----------------------------
INSERT INTO `be_Languages` VALUES ('1', 'Укр', 'ua', '1', 'uk', '2', '61', '1', '{SITE_URL}/frontend/webcontent/images/langs/flag-ua.png');
INSERT INTO `be_Languages` VALUES ('2', 'Рус', 'ru', '1', 'ru', '1', '61', '1', '{SITE_URL}/frontend/webcontent/images/langs/flag-ru.png');
INSERT INTO `be_Languages` VALUES ('3', 'Eng', 'en', '22', 'en', '3', '61', '1', '{SITE_URL}/frontend/webcontent/images/langs/flag-en.png');

-- ----------------------------
-- Table structure for `be_LanguagesContent`
-- ----------------------------
DROP TABLE IF EXISTS `be_LanguagesContent`;
CREATE TABLE `be_LanguagesContent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `langId` int(3) unsigned DEFAULT NULL,
  `websiteId` int(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_LanguagesContent
-- ----------------------------
INSERT INTO `be_LanguagesContent` VALUES ('1', '1', '1');
INSERT INTO `be_LanguagesContent` VALUES ('2', '3', '1');

-- ----------------------------
-- Table structure for `be_List`
-- ----------------------------
DROP TABLE IF EXISTS `be_List`;
CREATE TABLE `be_List` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listName` varchar(100) DEFAULT NULL,
  `listDescription` varchar(255) DEFAULT NULL,
  `viewId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of be_List
-- ----------------------------
INSERT INTO `be_List` VALUES ('1', 'Тип новостей', 'Содержит список типов новостей. На пример, новость и статья', '10');
INSERT INTO `be_List` VALUES ('2', 'Доступні модулі', 'Доступні модулі', '10');
INSERT INTO `be_List` VALUES ('3', 'Список брендів', 'Список брендів продукту', '10');
INSERT INTO `be_List` VALUES ('4', 'Валюта', 'Валюта', '10');

-- ----------------------------
-- Table structure for `be_ListItems`
-- ----------------------------
DROP TABLE IF EXISTS `be_ListItems`;
CREATE TABLE `be_ListItems` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `listId` int(11) DEFAULT NULL,
  `listItemName` varchar(100) DEFAULT NULL,
  `visible` tinyint(3) unsigned NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `orderNr` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `index` (`listId`),
  CONSTRAINT `fk_List_listItems` FOREIGN KEY (`listId`) REFERENCES `be_List` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of be_ListItems
-- ----------------------------
INSERT INTO `be_ListItems` VALUES ('2', '1', 'Загальні новини', '1', 'Загальні новини', '2');
INSERT INTO `be_ListItems` VALUES ('3', '2', 'Категорії', '1', 'productsNavigation', '1');
INSERT INTO `be_ListItems` VALUES ('4', '3', 'AREFEVA', '1', '', '1');
INSERT INTO `be_ListItems` VALUES ('5', '4', 'EUR', '1', '', '1');

-- ----------------------------
-- Table structure for `be_ListItemTranslation`
-- ----------------------------
DROP TABLE IF EXISTS `be_ListItemTranslation`;
CREATE TABLE `be_ListItemTranslation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `listItemId` int(11) unsigned NOT NULL DEFAULT '0',
  `langId` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `listItemId_langId` (`listItemId`,`langId`),
  KEY `fk_lang_listitemtr` (`langId`),
  CONSTRAINT `fk_lang_listitemtr` FOREIGN KEY (`langId`) REFERENCES `be_Languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_listitem_translation` FOREIGN KEY (`listItemId`) REFERENCES `be_ListItems` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_ListItemTranslation
-- ----------------------------
INSERT INTO `be_ListItemTranslation` VALUES ('1', '4', '3', 'Arefeva');

-- ----------------------------
-- Table structure for `be_Log`
-- ----------------------------
DROP TABLE IF EXISTS `be_Log`;
CREATE TABLE `be_Log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `fileName` varchar(255) DEFAULT NULL,
  `lineNum` tinyint(3) unsigned DEFAULT NULL,
  `pageUrl` varchar(255) NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `visitorIp` varchar(15) NOT NULL,
  `traceStr` text,
  `request` text,
  `logType` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of be_Log
-- ----------------------------
INSERT INTO `be_Log` VALUES ('1', 'OrderPageData.loadBase(...). pagecode wrong', 'D:ProgramsOpenServerdomainsiprocms-shop.localframeworkdata_objectsaseOrderPageData.php', '24', 'iprocms-shop.local/en/orderModerationPreview/99.htm', '2014-06-20 14:18:51', '127.0.0.1', '#0 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(155): OrderPageData->loadBase()\n#1 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(90): Page->loadPageData()\n#2 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\frontend\\pages\\orderModerationPreview.php(65): Page->__construct()\n#3 {main}', 'a:0:{}', null);
INSERT INTO `be_Log` VALUES ('2', 'Error in query', 'D:ProgramsOpenServerdomainsiprocms-shop.localframeworkdata_objectsaseDataObject.php', '165', 'iprocms-shop.local/en/orderModerationPreview/99.htm', '2014-06-20 14:18:51', '127.0.0.1', '#0 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\data_objects\\base\\DataObject.php(98): DataObject->runQuery(\'SELECT * FROM f...\')\n#1 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\data_objects\\base\\MasterPageData.php(48): DataObject->load()\n#2 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(193): MasterPageData->load()\n#3 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(126): MasterPage->loadMasterPageData(1)\n#4 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(223): MasterPage->createAreasPageObjects()\n#5 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(60): MasterPage->init()\n#6 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(95): MasterPage->__construct(1)\n#7 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\frontend\\pages\\error.php(40): Page->__construct()\n#8 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(349): include_once(\'D:\\Programs\\Ope...\')\n#9 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(98): Page->pageNotFound()\n#10 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\frontend\\pages\\orderModerationPreview.php(65): Page->__construct()\n#11 {main}', 'a:0:{}', null);
INSERT INTO `be_Log` VALUES ('3', 'OrderPageData.loadBase(...). pagecode wrong', 'D:ProgramsOpenServerdomainsiprocms-shop.localframeworkdata_objectsaseOrderPageData.php', '48', 'iprocms-shop.local/en/orderModerationPreview/98.htm', '2014-06-20 14:22:42', '127.0.0.1', '#0 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(155): OrderPageData->loadBase()\n#1 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(90): Page->loadPageData()\n#2 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\frontend\\pages\\orderModerationPreview.php(65): Page->__construct()\n#3 {main}', 'a:0:{}', null);
INSERT INTO `be_Log` VALUES ('4', 'Error in query', 'D:ProgramsOpenServerdomainsiprocms-shop.localframeworkdata_objectsaseDataObject.php', '165', 'iprocms-shop.local/en/orderModerationPreview/98.htm', '2014-06-20 14:22:42', '127.0.0.1', '#0 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\data_objects\\base\\DataObject.php(98): DataObject->runQuery(\'SELECT * FROM f...\')\n#1 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\data_objects\\base\\MasterPageData.php(48): DataObject->load()\n#2 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(193): MasterPageData->load()\n#3 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(126): MasterPage->loadMasterPageData(1)\n#4 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(223): MasterPage->createAreasPageObjects()\n#5 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(60): MasterPage->init()\n#6 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(95): MasterPage->__construct(1)\n#7 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\frontend\\pages\\error.php(40): Page->__construct()\n#8 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(349): include_once(\'D:\\Programs\\Ope...\')\n#9 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(98): Page->pageNotFound()\n#10 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\frontend\\pages\\orderModerationPreview.php(65): Page->__construct()\n#11 {main}', 'a:0:{}', null);
INSERT INTO `be_Log` VALUES ('5', 'OrderPageData.loadBase(...). pagecode wrong', 'D:ProgramsOpenServerdomainsiprocms-shop.localframeworkdata_objectsaseOrderPageData.php', '48', 'iprocms-shop.local/en/orderModerationPreview/97.htm', '2014-06-20 14:23:07', '127.0.0.1', '#0 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(155): OrderPageData->loadBase()\n#1 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(90): Page->loadPageData()\n#2 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\frontend\\pages\\orderModerationPreview.php(65): Page->__construct()\n#3 {main}', 'a:0:{}', null);
INSERT INTO `be_Log` VALUES ('6', 'Error in query', 'D:ProgramsOpenServerdomainsiprocms-shop.localframeworkdata_objectsaseDataObject.php', '165', 'iprocms-shop.local/en/orderModerationPreview/97.htm', '2014-06-20 14:23:07', '127.0.0.1', '#0 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\data_objects\\base\\DataObject.php(98): DataObject->runQuery(\'SELECT * FROM f...\')\n#1 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\data_objects\\base\\MasterPageData.php(48): DataObject->load()\n#2 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(193): MasterPageData->load()\n#3 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(126): MasterPage->loadMasterPageData(1)\n#4 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(223): MasterPage->createAreasPageObjects()\n#5 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(60): MasterPage->init()\n#6 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(95): MasterPage->__construct(1)\n#7 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\frontend\\pages\\error.php(40): Page->__construct()\n#8 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(349): include_once(\'D:\\Programs\\Ope...\')\n#9 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(98): Page->pageNotFound()\n#10 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\frontend\\pages\\orderModerationPreview.php(65): Page->__construct()\n#11 {main}', 'a:0:{}', null);
INSERT INTO `be_Log` VALUES ('7', 'OrderPageData.loadBase(...). pagecode wrong', 'D:ProgramsOpenServerdomainsiprocms-shop.localframeworkdata_objectsaseOrderPageData.php', '48', 'iprocms-shop.local/en/orderModerationPreview/96.htm', '2014-06-20 14:24:09', '127.0.0.1', '#0 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(155): OrderPageData->loadBase()\n#1 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(90): Page->loadPageData()\n#2 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\frontend\\pages\\orderModerationPreview.php(65): Page->__construct()\n#3 {main}', 'a:0:{}', null);
INSERT INTO `be_Log` VALUES ('8', 'Error in query', 'D:ProgramsOpenServerdomainsiprocms-shop.localframeworkdata_objectsaseDataObject.php', '165', 'iprocms-shop.local/en/orderModerationPreview/96.htm', '2014-06-20 14:24:09', '127.0.0.1', '#0 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\data_objects\\base\\DataObject.php(98): DataObject->runQuery(\'SELECT * FROM f...\')\n#1 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\data_objects\\base\\MasterPageData.php(48): DataObject->load()\n#2 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(193): MasterPageData->load()\n#3 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(126): MasterPage->loadMasterPageData(1)\n#4 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(223): MasterPage->createAreasPageObjects()\n#5 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(60): MasterPage->init()\n#6 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(95): MasterPage->__construct(1)\n#7 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\frontend\\pages\\error.php(40): Page->__construct()\n#8 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(349): include_once(\'D:\\Programs\\Ope...\')\n#9 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(98): Page->pageNotFound()\n#10 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\frontend\\pages\\orderModerationPreview.php(65): Page->__construct()\n#11 {main}', 'a:0:{}', null);
INSERT INTO `be_Log` VALUES ('9', 'OrderPageData.loadBase(...). pagecode wrong', 'D:ProgramsOpenServerdomainsiprocms-shop.localframeworkdata_objectsaseOrderPageData.php', '48', 'iprocms-shop.local/en/orderModerationPreview/97.htm', '2014-06-20 14:45:08', '127.0.0.1', '#0 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(155): OrderPageData->loadBase()\n#1 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(90): Page->loadPageData()\n#2 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\frontend\\pages\\orderModerationPreview.php(65): Page->__construct()\n#3 {main}', 'a:0:{}', null);
INSERT INTO `be_Log` VALUES ('10', 'Error in query', 'D:ProgramsOpenServerdomainsiprocms-shop.localframeworkdata_objectsaseDataObject.php', '165', 'iprocms-shop.local/en/orderModerationPreview/97.htm', '2014-06-20 14:45:08', '127.0.0.1', '#0 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\data_objects\\base\\DataObject.php(98): DataObject->runQuery(\'SELECT * FROM f...\')\n#1 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\data_objects\\base\\MasterPageData.php(48): DataObject->load()\n#2 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(193): MasterPageData->load()\n#3 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(126): MasterPage->loadMasterPageData(1)\n#4 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(223): MasterPage->createAreasPageObjects()\n#5 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\MasterPage.php(60): MasterPage->init()\n#6 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(95): MasterPage->__construct(1)\n#7 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\frontend\\pages\\error.php(40): Page->__construct()\n#8 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(349): include_once(\'D:\\Programs\\Ope...\')\n#9 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\framework\\core\\Page.php(98): Page->pageNotFound()\n#10 D:\\Programs\\OpenServer\\domains\\iprocms-shop.local\\frontend\\pages\\orderModerationPreview.php(65): Page->__construct()\n#11 {main}', 'a:0:{}', null);
INSERT INTO `be_Log` VALUES ('11', 'Order. Wrong params orderId: dev_99_1404996040, userId: ', 'D:OpenServerdomainsiprocmsframeworksystemwebshoporder.php', '87', 'iprocms/en/orderModerationPreview/1.htm', '2014-07-14 16:41:44', '127.0.0.1', '#0 D:\\OpenServer\\domains\\iprocms\\framework\\system\\webshop\\order.php(42): Order->getData()\n#1 D:\\OpenServer\\domains\\iprocms\\frontend\\pages\\orderModerationPreview.php(29): Order->__construct(\'dev_99_14049960...\')\n#2 D:\\OpenServer\\domains\\iprocms\\framework\\core\\Page.php(241): OrderModerationPreview->load()\n#3 D:\\OpenServer\\domains\\iprocms\\frontend\\pages\\orderModerationPreview.php(66): Page->run()\n#4 {main}', 'a:0:{}', null);
INSERT INTO `be_Log` VALUES ('12', 'Order. Wrong params orderId: dev_99_1404996040, userId: ', 'D:OpenServerdomainsiprocmsframeworksystemwebshoporder.php', '87', 'iprocms/en/orderModerationPreview/1.htm', '2014-07-14 16:48:24', '127.0.0.1', '#0 D:\\OpenServer\\domains\\iprocms\\framework\\system\\webshop\\order.php(42): Order->getData()\n#1 D:\\OpenServer\\domains\\iprocms\\frontend\\pages\\orderModerationPreview.php(29): Order->__construct(\'dev_99_14049960...\')\n#2 D:\\OpenServer\\domains\\iprocms\\framework\\core\\Page.php(241): OrderModerationPreview->load()\n#3 D:\\OpenServer\\domains\\iprocms\\frontend\\pages\\orderModerationPreview.php(66): Page->run()\n#4 {main}', 'a:0:{}', null);
INSERT INTO `be_Log` VALUES ('13', 'Order. Wrong params orderId: dev_99_1404996040, userId: ', 'D:OpenServerdomainsiprocmsframeworksystemwebshoporder.php', '87', 'iprocms/en/orderModerationPreview/1.htm', '2014-07-14 16:48:35', '127.0.0.1', '#0 D:\\OpenServer\\domains\\iprocms\\framework\\system\\webshop\\order.php(42): Order->getData()\n#1 D:\\OpenServer\\domains\\iprocms\\frontend\\pages\\orderModerationPreview.php(29): Order->__construct(\'dev_99_14049960...\')\n#2 D:\\OpenServer\\domains\\iprocms\\framework\\core\\Page.php(241): OrderModerationPreview->load()\n#3 D:\\OpenServer\\domains\\iprocms\\frontend\\pages\\orderModerationPreview.php(66): Page->run()\n#4 {main}', 'a:0:{}', null);
INSERT INTO `be_Log` VALUES ('14', 'Order. Wrong params orderId: dev_99_1404996040, userId: ', 'D:OpenServerdomainsiprocmsframeworksystemwebshoporder.php', '87', 'iprocms/en/orderModerationPreview/1.htm', '2014-07-14 16:51:00', '127.0.0.1', '#0 D:\\OpenServer\\domains\\iprocms\\framework\\system\\webshop\\order.php(42): Order->getData()\n#1 D:\\OpenServer\\domains\\iprocms\\frontend\\pages\\orderModerationPreview.php(29): Order->__construct(\'dev_99_14049960...\')\n#2 D:\\OpenServer\\domains\\iprocms\\framework\\core\\Page.php(241): OrderModerationPreview->load()\n#3 D:\\OpenServer\\domains\\iprocms\\frontend\\pages\\orderModerationPreview.php(66): Page->run()\n#4 {main}', 'a:0:{}', null);
INSERT INTO `be_Log` VALUES ('15', 'Order. Wrong params orderId: dev_99_1404996040, userId: ', 'D:OpenServerdomainsiprocmsframeworksystemwebshoporder.php', '87', 'iprocms/en/orderModerationPreview/1.htm', '2014-07-14 16:51:24', '127.0.0.1', '#0 D:\\OpenServer\\domains\\iprocms\\framework\\system\\webshop\\order.php(42): Order->getData()\n#1 D:\\OpenServer\\domains\\iprocms\\frontend\\pages\\orderModerationPreview.php(29): Order->__construct(\'dev_99_14049960...\')\n#2 D:\\OpenServer\\domains\\iprocms\\framework\\core\\Page.php(241): OrderModerationPreview->load()\n#3 D:\\OpenServer\\domains\\iprocms\\frontend\\pages\\orderModerationPreview.php(66): Page->run()\n#4 {main}', 'a:0:{}', null);
INSERT INTO `be_Log` VALUES ('16', 'Order. Wrong params orderId: dev_99_1404996040, userId: ', 'D:OpenServerdomainsiprocmsframeworksystemwebshoporder.php', '87', 'iprocms/en/orderModerationPreview/1.htm', '2014-07-14 16:52:06', '127.0.0.1', '#0 D:\\OpenServer\\domains\\iprocms\\framework\\system\\webshop\\order.php(42): Order->getData()\n#1 D:\\OpenServer\\domains\\iprocms\\frontend\\pages\\orderModerationPreview.php(29): Order->__construct(\'dev_99_14049960...\')\n#2 D:\\OpenServer\\domains\\iprocms\\framework\\core\\Page.php(241): OrderModerationPreview->load()\n#3 D:\\OpenServer\\domains\\iprocms\\frontend\\pages\\orderModerationPreview.php(66): Page->run()\n#4 {main}', 'a:0:{}', null);
INSERT INTO `be_Log` VALUES ('17', 'Page not found in database. id/code  =  /body-blouseuu2', 'D:OpenServerdomainsshopframeworkcorePage.php', '156', 'shop/en/product/body-blouseuu2.htm', '2014-07-18 14:24:36', '127.0.0.1', '#0 D:\\OpenServer\\domains\\shop\\framework\\core\\Page.php(90): Page->loadPageData()\n#1 D:\\OpenServer\\domains\\shop\\frontend\\pages\\product.php(66): Page->__construct()\n#2 {main}', 'a:0:{}', null);
INSERT INTO `be_Log` VALUES ('18', 'Page not found in database. id/code  =  /bodrerry-blouse', 'D:OpenServerdomainsshopframeworkcorePage.php', '156', 'shop/en/catalog/bodrerry-blouse.htm', '2014-08-06 14:34:02', '127.0.0.1', '#0 D:\\OpenServer\\domains\\shop\\framework\\core\\Page.php(90): Page->loadPageData()\n#1 D:\\OpenServer\\domains\\shop\\frontend\\pages\\catalog.php(70): Page->__construct()\n#2 {main}', 'a:0:{}', null);

-- ----------------------------
-- Table structure for `be_MailTemplates`
-- ----------------------------
DROP TABLE IF EXISTS `be_MailTemplates`;
CREATE TABLE `be_MailTemplates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `langId` int(11) unsigned NOT NULL DEFAULT '1',
  `relationId` char(36) CHARACTER SET cp1251 DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `body` text,
  `eventId` int(11) unsigned NOT NULL,
  `emails` text CHARACTER SET cp1251,
  `cc` text CHARACTER SET cp1251,
  `active` int(1) NOT NULL,
  `seeAddresses` int(1) NOT NULL,
  `websiteId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `poiId` int(11) DEFAULT NULL,
  `bcc` text CHARACTER SET cp1251,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_MailTemplates
-- ----------------------------
INSERT INTO `be_MailTemplates` VALUES ('1', '3', null, 'Registration Confirmation mail', 'User registration', '<div style=\"width:710px;margin: 0 auto;\">\n<div style=\"width:560px;padding: 0 75px;background:url(\'http://{SITE_NAME}/frontend/webcontent/system_images/category-bg.jpg\');height:145px;\">\n<h1 style=\"font-size:21px;font-weight:bold;color:#2B92E8;float:right; margin:85px 0 0;\">&nbsp;</h1>\n</div>\n<div style=\"width:560px;margin:0 auto;font-size:14px;color:#333333;\">\n<p><span style=\"color: rgb(43, 146, 232); font-size: 21px; font-weight: bold; \">Welcome to dreamblouses.com!</span></p>\n<div>Thank you for registration!</div>\n<div>\n<h2 style=\"font-size:18px;\"><span lang=\"EN-US\" style=\"font-size:11.0pt;line-height:\n115%;font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:minor-latin;\nmso-fareast-font-family:Calibri;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:\nminor-latin;mso-bidi-font-family:&quot;Times New Roman&quot;;mso-bidi-theme-font:minor-bidi;\nmso-ansi-language:EN-US;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">To  confirm your dreamblouses.com account, click the link below (you can also  copy and paste this link directly into your browser&rsquo;s address bar):</span></h2>\n<p><a style=\"color:#1186E8;\" target=\"_blank\" href=\"{USER_CONFIRMATION_LINK}\">{USER_CONFIRMATION_LINK}</a></p>\n<br />\n<span style=\"font-size: small; \"><span lang=\"EN-GB\" style=\"line-height: 115%; font-family: Verdana, sans-serif; color: rgb(51, 51, 51); \">Please don&rsquo;t reply to this e-mail. It has been sent by a post robot of dreamblouses.com site. If you have any questions, contact us on </span></span><span style=\"font-size:\n11.0pt;line-height:115%;font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:\nminor-latin;mso-fareast-font-family:Calibri;mso-fareast-theme-font:minor-latin;\nmso-hansi-theme-font:minor-latin;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi;mso-ansi-language:UK;mso-fareast-language:EN-US;\nmso-bidi-language:AR-SA\"><a href=\"mailto:info@igotoworld.com\"><span style=\"font-size: small; \"><span lang=\"EN-GB\" style=\"line-height: 115%; font-family: Verdana, sans-serif; \">info@dreamblouses.com</span></span></a></span></div>\n<br />\n<p>&nbsp;</p>\n</div>\n</div>\n<p>&nbsp;</p>', '1', 'm.melnichuk@iproaction.com, {USER_EMAIL}', '', '1', '0', '1', '0', '0', '');
INSERT INTO `be_MailTemplates` VALUES ('2', '3', null, 'Change User Password', 'Updating  password', '<div style=\"width:710px;margin: 0 auto;\">\n<div style=\"width:560px;padding: 0 75px;background:url(\'http://{SITE_NAME}/frontend/webcontent/system_images/category-bg.jpg\');height:145px;\">\n<h1 style=\"font-size:21px;font-weight:bold;color:#2B92E8;float:right; margin:85px 0 0;\">&nbsp;</h1>\n</div>\n<div style=\"width:560px;margin:0 auto;font-size:14px;color:#333333;\">\n<p><span style=\"color: rgb(43, 146, 232); font-size: 21px; font-weight: bold; \">Welcome to dreamblouses.com!</span></p>\n<div>Hello {USER_NAME}!</div>\n<div>&nbsp;</div>\n<div>Your new password: {USER_NEW_PASSWORD}</div>\n<div>\n<p><br />\n&nbsp;</p>\n<span style=\"font-size: small; \"><span lang=\"EN-GB\" style=\"line-height: 115%; font-family: Verdana, sans-serif; color: rgb(51, 51, 51); \">Please don&rsquo;t reply to this e-mail. It has been sent by a post robot of </span></span><span style=\"font-size: small; \"><span lang=\"EN-GB\" style=\"line-height: 115%; font-family: Verdana, sans-serif; color: rgb(51, 51, 51); \"><span style=\"font-size: small; \"><span lang=\"EN-GB\" style=\"line-height: 115%; font-family: Verdana, sans-serif; color: rgb(51, 51, 51); \">dreamblouses.com </span></span>site. If you have any questions, contact us on </span></span><span style=\"font-size:\n11.0pt;line-height:115%;font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:\nminor-latin;mso-fareast-font-family:Calibri;mso-fareast-theme-font:minor-latin;\nmso-hansi-theme-font:minor-latin;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi;mso-ansi-language:UK;mso-fareast-language:EN-US;\nmso-bidi-language:AR-SA\"><a href=\"mailto:info@igotoworld.com\"><span style=\"font-size: small; \"><span lang=\"EN-GB\" style=\"line-height: 115%; font-family: Verdana, sans-serif; \">info@dreamblouses.com</span></span></a></span></div>\n</div>\n</div>\n<p>&nbsp;</p>', '2', '{USER_EMAIL}', '', '1', '0', '1', '0', null, '');

-- ----------------------------
-- Table structure for `be_Navigation`
-- ----------------------------
DROP TABLE IF EXISTS `be_Navigation`;
CREATE TABLE `be_Navigation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parentId` int(11) unsigned NOT NULL,
  `click` text,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `param1` varchar(255) DEFAULT NULL,
  `param2` varchar(255) DEFAULT NULL,
  `param3` varchar(255) DEFAULT NULL,
  `orderNumber` int(11) unsigned DEFAULT NULL,
  `visible` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of be_Navigation
-- ----------------------------
INSERT INTO `be_Navigation` VALUES ('1', '0', 'null', 'Content', 'index.php?action=contentmanager', 'contentmanager', null, null, '1', '');
INSERT INTO `be_Navigation` VALUES ('2', '0', 'null', 'Products', 'index.php?action=products', 'products', null, null, '2', '');
INSERT INTO `be_Navigation` VALUES ('3', '0', 'null', 'Users', 'index.php?action=users', 'users', null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('4', '0', 'null', 'File Manager', 'index.php?action=filemanager', 'filemanager', null, null, '3', '');
INSERT INTO `be_Navigation` VALUES ('5', '0', 'null', 'Settings', 'index.php?action=preferances', 'preferances', null, null, '4', '');
INSERT INTO `be_Navigation` VALUES ('7', '1', 'javascript:Menu.lmItemClick(\'ViewController\',\'viewBrowse\',{viewType:{0:1},searchType:\'general\'},this);', 'Add page', '', null, null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('8', '1', 'Menu.lmItemClick(\'ViewController\',\'viewBuild\',{viewId:1,searchType:\'general\'},this);', 'View pages', null, null, null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('9', '1', 'Menu.lmItemClick(\'ViewController\',\'viewBrowse\',{viewType:{0:3},searchType:\'general\'},this);', 'Add object', null, null, null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('10', '1', 'Menu.lmItemClick(\'ViewController\',\'viewBuild\',{viewId:2,searchType:\'general\'},this);', 'View objects', null, null, null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('11', '1', 'Menu.lmItemClick(\'ViewController\',\'viewBuild\',{viewId:5,searchType:\'general\'},this);', 'Templates', null, null, null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('12', '1', 'Menu.lmItemClick(\'ViewController\',\'viewBuild\',{viewId:28,searchType:\'general\'},this);', 'Static texts', '', null, null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('13', '1', 'Menu.lmItemClick(\'ViewController\',\'viewBuild\',{viewId:35,searchType:\'general\'},this);', 'Users of the site', null, null, null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('14', '0', 'Menu.menuItemClickPopupResult(\'CacheController\',\'deleteAllCache\',{group:\'false\'});', 'Clear the cache', '', null, null, null, '5', '');
INSERT INTO `be_Navigation` VALUES ('15', '2', 'Menu.lmItemClick(\'ViewController\',\'viewBuild\',{viewId:45,searchType:\'general\'},this);', 'Products', null, null, null, null, '1', '');
INSERT INTO `be_Navigation` VALUES ('16', '2', 'viewDataObject30 = new ViewDataObject(30,\'general\'); Menu.lmItemClick(\'ViewController\',\'viewBuild\',{viewId:30,itemId:26},this);', 'Category', null, null, null, null, '2', '');
INSERT INTO `be_Navigation` VALUES ('17', '5', 'Menu.lmItemClick(\'ViewController\',\'viewBuild\',{viewId:60,searchType:\'general\'},this);', 'Language', null, null, null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('18', '5', 'Menu.lmItemClick(\'ViewController\',\'viewBuild\',{viewId:121,searchType:\'general\'},this);', 'Role', null, null, null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('19', '5', 'Menu.lmItemClick(\'ViewController\',\'viewBuild\',{viewId:31,searchType:\'general\'},this);', 'Administrators', null, null, null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('20', '2', 'Menu.lmItemClick(\'ViewController\',\'viewBuild\',{viewId:44,searchType:\'general\'},this);', 'Product attributes', null, null, null, null, '3', '');
INSERT INTO `be_Navigation` VALUES ('25', '5', 'viewDataObject55 = new ViewDataObject(55,\'general\'); Menu.lmItemClick(\'ViewController\',\'viewBuild\',{viewId:55,itemId:document.getElementById(\'multiSiteSelect\').value},this);', 'Site configuration', null, null, null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('26', '5', 'Menu.lmItemClick(\'TasksController\',\'buildTasksForm\',{},this)', 'Processes', '', null, null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('27', '5', 'Menu.lmItemClick(\'LanguageController\',\'buildCopyContentForm\',{},this)', 'Copy content', null, null, null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('28', '5', 'Menu.lmItemClick(\'ViewController\',\'viewBuild\',{viewId:124,searchType:\'general\'},this);', 'Watermarks', null, null, null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('29', '5', 'Menu.lmItemClick(\'SiteController\',\'buildCopySiteForm\',{},this)', 'Create a site', null, null, null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('32', '5', 'Menu.lmItemClick(\'ViewController\',\'viewBuild\',{viewId:131,searchType:\'general\'},this);', 'Image', null, null, null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('35', '5', 'Menu.lmItemClick(\'ViewController\',\'viewBuild\',{viewId:3,searchType:\'general\'},this);', 'Dynamic lists', null, null, null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('36', '1', 'Menu.lmItemClick(\'ViewController\',\'viewBuild\',{viewId:71,searchType:\'general\'},this);', 'Mail templates', null, null, null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('37', '5', 'Menu.lmItemClick(\'ViewController\',\'viewBuild\',{viewId:139,searchType:\'general\',autoSearch:true},this);', 'Payment methods', null, null, null, null, null, '');
INSERT INTO `be_Navigation` VALUES ('38', '2', 'Menu.lmItemClick(\'ViewController\',\'viewBuild\',{viewId:65,searchType:\'general\'},this);', 'Order moderation', null, null, null, null, '4', '');

-- ----------------------------
-- Table structure for `be_PageContent`
-- ----------------------------
DROP TABLE IF EXISTS `be_PageContent`;
CREATE TABLE `be_PageContent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pageId` int(10) unsigned DEFAULT NULL,
  `contentId` int(10) unsigned DEFAULT NULL,
  `listId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `relation` (`pageId`,`contentId`),
  KEY `identity` (`listId`),
  KEY `contentId` (`contentId`),
  CONSTRAINT `fe_pagerelateditems_pagecontent` FOREIGN KEY (`contentId`) REFERENCES `fe_PagesRelatedItems` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_page_pagecontent` FOREIGN KEY (`pageId`) REFERENCES `fe_Pages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=273 DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of be_PageContent
-- ----------------------------
INSERT INTO `be_PageContent` VALUES ('270', '8701', '102', null);
INSERT INTO `be_PageContent` VALUES ('271', '8701', '101', null);
INSERT INTO `be_PageContent` VALUES ('272', '8701', '100', null);

-- ----------------------------
-- Table structure for `be_ProductContent`
-- ----------------------------
DROP TABLE IF EXISTS `be_ProductContent`;
CREATE TABLE `be_ProductContent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) DEFAULT NULL,
  `contentId` int(11) DEFAULT NULL,
  `listId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of be_ProductContent
-- ----------------------------
INSERT INTO `be_ProductContent` VALUES ('4', '18', '8', '2');
INSERT INTO `be_ProductContent` VALUES ('5', '18', '10', '1');
INSERT INTO `be_ProductContent` VALUES ('8', '17', '11', '1');
INSERT INTO `be_ProductContent` VALUES ('9', '17', '12', '2');

-- ----------------------------
-- Table structure for `be_UserStatus`
-- ----------------------------
DROP TABLE IF EXISTS `be_UserStatus`;
CREATE TABLE `be_UserStatus` (
  `id` int(11) NOT NULL DEFAULT '0',
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_UserStatus
-- ----------------------------
INSERT INTO `be_UserStatus` VALUES ('0', 'Не підтвердив реєстрацію');
INSERT INTO `be_UserStatus` VALUES ('1', 'Підтвердив реєстрацію');
INSERT INTO `be_UserStatus` VALUES ('2', 'Відмовлено у доступі');

-- ----------------------------
-- Table structure for `be_View`
-- ----------------------------
DROP TABLE IF EXISTS `be_View`;
CREATE TABLE `be_View` (
  `viewId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(250) NOT NULL,
  `tblName` char(200) NOT NULL,
  `className` char(250) NOT NULL,
  `viewType` tinyint(4) unsigned DEFAULT '0',
  `masterPageId` int(11) unsigned NOT NULL,
  `active` tinyint(3) NOT NULL DEFAULT '1',
  `deleteAllow` int(11) unsigned DEFAULT '1',
  `copyAllow` int(11) unsigned DEFAULT '1',
  `addItemViewId` int(11) DEFAULT NULL,
  `editAllow` int(11) DEFAULT '1',
  `canApply` int(1) DEFAULT '1',
  `autoSearch` int(1) DEFAULT '1',
  PRIMARY KEY (`viewId`),
  KEY `fk_viewtype_view` (`viewType`),
  CONSTRAINT `fk_viewtype_view` FOREIGN KEY (`viewType`) REFERENCES `be_ViewTypes` (`ViewTypeId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of be_View
-- ----------------------------
INSERT INTO `be_View` VALUES ('1', 'Search pages', 'fe_Pages', '', '4', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('2', 'Object search', 'fe_Pages', '', '4', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('3', 'Search lists', 'be_List', '', '4', '0', '1', '0', '0', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('4', 'Search of objects HeadInclude', 'fe_Pages', '', '4', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('5', 'Template management', 'fe_MasterPages', '', '4', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('6', 'Menu', 'fe_Pages', 'menuObject.php', '3', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('7', 'Directory', 'fe_Pages', '', '8', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('8', 'Navigation tree', 'fe_Pages', '', '8', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('9', 'Item in the navigation tree', 'fe_MenuItems', '', '5', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('10', 'Edit list', 'be_List', '', '6', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('11', 'Element dynamic list', 'be_ListItems', '', '5', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('12', 'Content page', 'fe_Pages', 'content.php', '1', '1', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('13', 'Page template', 'fe_MasterPages', '', '7', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('14', 'HTML text', 'fe_Pages', 'freeHTMLObject.php', '3', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('15', 'Image Link', 'fe_Pages', 'imageLinkObject.php', '3', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('16', 'HeadInculde', 'fe_Pages', 'headerIncludeObject.php', '3', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('17', 'Category', 'fe_ProductCategories', 'catalog.php', '5', '5', '1', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('18', 'News', 'fe_Pages', 'news.php', '1', '3', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('19', 'List of news', 'fe_Pages', 'news_list.php', '1', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('20', 'Module to the navigation tree', 'fe_MenuItems', '', '5', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('21', 'Main page', 'fe_Pages', 'home.php', '1', '3', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('22', 'Voting', 'fe_Pages', 'PoolObject.php', '3', '0', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('23', 'Survey entry', 'fe_PagesRelatedItems', '', '5', '0', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('24', 'Flash object', 'fe_Pages', 'FlashObject.php', '3', '0', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('25', 'List of photo galleries', 'fe_Pages', 'galleries_list.php', '1', '0', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('26', 'Photo-gallery', 'fe_Pages', 'photogallery.php', '1', '0', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('27', 'Photo gallery', 'fe_PagesRelatedItems', '', '5', '0', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('28', 'Static text search', 'fe_WebText', '', '4', '0', '1', '0', '0', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('29', 'Static text', 'fe_WebText', '', '5', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('30', 'Edit directory', 'fe_Pages', '', '6', '0', '0', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('31', 'Search editors', 'be_Admin', '', '4', '0', '0', '0', '0', '32', '1', '1', '1');
INSERT INTO `be_View` VALUES ('32', 'Editor', 'be_Admin', '', '9', '6', '0', '0', '0', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('33', 'The user (edit profile)', 'fe_Pages', 'myinfo.php', '1', '1', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('34', 'Authorization form', 'fe_Pages', 'SignInObject.php', '3', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('35', 'Search users', 'fe_Users', '', '4', '0', '0', '0', '0', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('36', 'User', 'fe_Users', 'user.php', '9', '6', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('37', 'Page. login/registration', 'fe_Pages', 'signregister.php', '2', '0', '1', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('38', 'Dynamic list item transl', 'be_ListItemTranslation', '', '5', '0', '1', '1', '1', '0', '1', '1', '0');
INSERT INTO `be_View` VALUES ('39', 'Search page', 'fe_Pages', 'search.php', '2', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('40', 'The form of search', 'fe_Pages', 'SearchObject.php', '8', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('41', 'Feedback', 'fe_Pages', 'contact.php', '1', '0', '1', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('42', 'Translation Category', 'fe_ProductCategoryTranslations', '', '5', '0', '1', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('44', 'Searching For Attributes', 'fe_ProductAttributes', '', '4', '0', '1', '0', '0', '49', '1', '1', '1');
INSERT INTO `be_View` VALUES ('45', 'Product search', 'fe_Products', '', '4', '0', '1', '0', '1', '46', '1', '1', '1');
INSERT INTO `be_View` VALUES ('46', 'Product', 'fe_Products', 'product.php', '10', '0', '1', '0', '0', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('47', 'Translation Of The Product', 'fe_ProductTranslations', '', '5', '0', '1', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('48', 'Product Option', 'fe_ProductVariations', '', '5', '0', '1', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('49', 'Product attribute', 'fe_ProductAttributes', '', '10', '0', '1', '0', '0', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('50', 'Translation application of the product', 'fe_ProductAttributeTranslations', '', '5', '0', '1', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('51', 'Parameters used for products', 'fe_ProductAttributeItems', '', '5', '0', '1', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('52', 'Translation attribute value product', 'fe_ProductAttributeItemTranslations', '', '5', '0', '1', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('53', 'List of news', 'fe_Pages', 'newsListObject.php', '3', '0', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('54', 'List of sites', 'be_WebSites', '', '4', '0', '0', '1', '0', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('55', 'Site configuration', 'be_WebSites', '', '9', '0', '0', '0', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('56', 'Associated with the site language', 'be_WebsiteLanguages', '', '5', '0', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('57', 'Photo for Products', 'fe_ProductImages', '', '5', '0', '1', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('60', 'List Of Languages', 'be_Languages', '', '4', '0', '0', '1', '0', '61', '1', '1', '1');
INSERT INTO `be_View` VALUES ('61', 'Language editing', 'be_Languages', '', '6', '0', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('62', 'Language selection', 'fe_Pages', 'languageSelector.php', '3', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('63', 'Changing the image size', 'be_ImageSizes', '', '9', '0', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('65', 'Orders moderation', 'fe_Orders', '', '4', '1', '1', '0', '0', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('66', 'Order moderation preview', 'fe_Orders', 'orderModerationPreview.php', '2', '29', '1', '0', '0', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('70', 'Шаблон листа', 'be_MailTemplates', '', '5', '0', '1', '1', '1', '0', '1', '1', '0');
INSERT INTO `be_View` VALUES ('71', 'Пошук шаблонів листів', 'be_MailTemplates', '', '4', '0', '1', '1', '1', '70', '1', '1', '0');
INSERT INTO `be_View` VALUES ('75', 'Registration page', 'fe_Pages', 'register.php', '2', '0', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('76', 'Confirmation of registration', 'fe_Pages', 'regconfirm.php', '2', '0', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('77', 'Password reminder', 'fe_Pages', 'passwd.php', '2', '0', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('83', 'Personal Cabinet', 'fe_Pages', 'privateOffice.php', '2', '1', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('84', 'User data', 'fe_Pages', 'userData.php', '2', '1', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('85', 'Vacancies', 'fe_Pages', 'vacancy.php', '1', '3', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('86', 'List of vacancies', 'fe_Pages', 'vacancy_list.php', '1', '0', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('87', 'Awards', 'fe_Pages', 'reward.php', '1', '3', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('88', 'Subscribe', 'fe_Pages', 'subscribeRSSObject.php', '3', '0', '1', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('108', '404', 'fe_Pages', 'error.php', '1', '1', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('109', 'Related news', 'fe_Pages', 'attachedNewsObject.php', '8', '0', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('114', 'Search for messages', 'be_ContactMessages', '', '4', '0', '0', '0', '0', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('115', 'Message', 'be_ContactMessages', '', '5', '0', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('116', 'Site map', 'fe_Pages', 'siteMap.php', '1', '1', '1', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('117', 'Photo main page', 'fe_PagesRelatedItems', '', '5', '0', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('120', 'Role', 'tbl_Roles', '', '8', '1', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('121', 'Role', 'tbl_Roles', '', '4', '0', '0', '1', '1', '120', '1', '1', '1');
INSERT INTO `be_View` VALUES ('123', 'Watermarks', 'be_WaterMarks', '', '9', '0', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('124', 'List of watermark', 'be_WaterMarks', '', '4', '0', '0', '1', '0', '123', '1', '1', '1');
INSERT INTO `be_View` VALUES ('130', 'Image', 'be_Images', '', '9', '0', '0', '0', '0', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('131', 'List of images', 'be_Images', '', '4', '0', '0', '0', '0', '130', '1', '1', '1');
INSERT INTO `be_View` VALUES ('132', 'Editing the purpose of image data', 'be_ImageDescription', '', '9', '0', '0', '1', '1', null, '1', '1', '1');
INSERT INTO `be_View` VALUES ('133', 'Shopping cart object', 'fe_Pages', 'shoppingCartObject.php', '3', '0', '1', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('134', 'Shopping bag', 'fe_Pages', 'shoppingbag.php', '2', '1', '1', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('135', 'Shopping bag: login', 'fe_Pages', 'sb_signin_register.php', '2', '1', '1', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('136', 'Shopping bag: billing, shipping', 'fe_Pages', 'sb_billing_shipping.php', '2', '1', '1', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('137', 'Shopping bag: overview', 'fe_Pages', 'sb_overview.php', '2', '1', '1', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('138', 'Shopping bag: confirmation', 'fe_Pages', 'sb_confirmation.php', '2', '1', '1', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('139', 'Search payment providers', 'fe_PaymentProviders', '', '4', '0', '1', '0', '0', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('140', 'Payment providers', 'fe_PaymentProviders', '', '9', '0', '1', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('141', 'Shopping bag: cancel payment', 'fe_Pages', 'sb_cancel.php', '2', '1', '1', '1', '1', '0', '1', '1', '1');
INSERT INTO `be_View` VALUES ('142', 'User orders list', 'fe_Pages', 'myorders.php', '1', '1', '1', '1', '1', '0', '1', '1', '1');

-- ----------------------------
-- Table structure for `be_ViewTypes`
-- ----------------------------
DROP TABLE IF EXISTS `be_ViewTypes`;
CREATE TABLE `be_ViewTypes` (
  `ViewTypeId` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  PRIMARY KEY (`ViewTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of be_ViewTypes
-- ----------------------------
INSERT INTO `be_ViewTypes` VALUES ('1', 'Page', 'Данний тип відповідає сторінкам, що користувач адмін панелі може вільно створювати. Ці сторінки являються основними для сайту.');
INSERT INTO `be_ViewTypes` VALUES ('2', 'SystemPage', '');
INSERT INTO `be_ViewTypes` VALUES ('3', 'PageObject', 'Це допоміжні контенти, які несуть в собі допоміжну інформацію або невелику частину логіки (меню, елементи флеш ...).Дані обєкти звязуються з сторінками.');
INSERT INTO `be_ViewTypes` VALUES ('4', 'Search', 'View, що використовуюються для пошуку в адмін панелі сайту.');
INSERT INTO `be_ViewTypes` VALUES ('5', 'ChildViews', 'View, які необхідні тільки для редагування даних в адмнці');
INSERT INTO `be_ViewTypes` VALUES ('6', 'BackendPage', 'View, які необхідні для редагування даних в Dynamic Content полях та Menu Items');
INSERT INTO `be_ViewTypes` VALUES ('7', 'MasterPage', 'використовується для побудови сторінки редагування майстер пейджів');
INSERT INTO `be_ViewTypes` VALUES ('8', 'SystemObject', 'для початку, цей тип буде поєднувати обєкти навігації, а також обєкти для в ключення у <HEAD> область контент-сторінки. Ці обєкти не можуть бути включені в сторінку як ПО');
INSERT INTO `be_ViewTypes` VALUES ('9', 'BackEndView', '');
INSERT INTO `be_ViewTypes` VALUES ('10', 'Product', 'Тип вю поєднує всі записи із таблички fe_Products. Використовується для відокремлення продуктів, оголошень від основного контенту');
INSERT INTO `be_ViewTypes` VALUES ('11', 'Order', 'Замовлення');
INSERT INTO `be_ViewTypes` VALUES ('12', 'Structure', 'Структура');

-- ----------------------------
-- Table structure for `be_WaterMarks`
-- ----------------------------
DROP TABLE IF EXISTS `be_WaterMarks`;
CREATE TABLE `be_WaterMarks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `viewId` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_WaterMarks
-- ----------------------------

-- ----------------------------
-- Table structure for `be_WebsiteLanguages`
-- ----------------------------
DROP TABLE IF EXISTS `be_WebsiteLanguages`;
CREATE TABLE `be_WebsiteLanguages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `masterPageId` int(11) unsigned DEFAULT NULL,
  `langId` int(3) unsigned DEFAULT NULL,
  `defaultLang` tinyint(3) unsigned DEFAULT '0',
  `websiteId` int(11) unsigned DEFAULT NULL,
  `defaultUrl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `WebsiteIdLangId` (`websiteId`,`langId`),
  CONSTRAINT `fk_website_languages` FOREIGN KEY (`websiteId`) REFERENCES `be_WebSites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_WebsiteLanguages
-- ----------------------------
INSERT INTO `be_WebsiteLanguages` VALUES ('70', '22', '3', '1', '1', '{SITE_URL_PAGES}home.php?pagecode=home&lang=en');
INSERT INTO `be_WebsiteLanguages` VALUES ('71', '27', '4', '0', '1', '#');
INSERT INTO `be_WebsiteLanguages` VALUES ('72', '24', '5', '0', '1', '#');
INSERT INTO `be_WebsiteLanguages` VALUES ('73', '0', '6', '0', '1', '{SITE_URL_PAGES}sb_overview.php?pagecode=order-overview&lang=fr');

-- ----------------------------
-- Table structure for `be_WebSites`
-- ----------------------------
DROP TABLE IF EXISTS `be_WebSites`;
CREATE TABLE `be_WebSites` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `viewId` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `URL` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `multiLanguage` int(2) unsigned NOT NULL DEFAULT '0',
  `useCache` int(2) unsigned NOT NULL DEFAULT '0',
  `useSMTP` int(2) unsigned NOT NULL DEFAULT '0',
  `SMTPServer` varchar(255) DEFAULT NULL,
  `SMTPUser` varchar(255) DEFAULT NULL,
  `SMTPPassword` varchar(255) DEFAULT NULL,
  `defaultAvatarImage` varchar(255) DEFAULT NULL,
  `registerSystemPageUrl` varchar(255) DEFAULT NULL,
  `usersAgreementPageUrl` varchar(255) DEFAULT NULL,
  `siteRulesPageUrl` varchar(255) DEFAULT NULL,
  `defaultPageClass` varchar(24) DEFAULT NULL,
  `dateFormat` varchar(50) DEFAULT 'dd.mm.yy',
  `useImageProcessing` int(2) unsigned DEFAULT '0',
  `useWaterMarks` int(2) unsigned DEFAULT '0',
  `countryId` int(11) DEFAULT NULL,
  `gagTitle` varchar(250) DEFAULT NULL,
  `gagHtml` text,
  `isGag` int(1) unsigned DEFAULT NULL,
  `gagIPs` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_WebSites
-- ----------------------------
INSERT INTO `be_WebSites` VALUES ('1', '55', 'iProShop', 'tailor.local', 'no-reply@dreamblouses.com', '1', '1', '0', 'localhost', '', '', '', '{SITE_URL_PAGES}register.php?pagecode=registration&lang=ua', '{SITE_URL_PAGES}content.php?pagecode=ugoda-koristuvacha&lang=ua', '{SITE_URL_PAGES}content.php?pagecode=pravila-koristuvannya-saytom&lang=ua', 'home', 'dd.mm.yy', '1', '0', null, 'IPro Cms', '<p style=\"text-align: center;\">ghfryrt sdfg dfs gdsf g sdfgdfg</p>\n<p style=\"text-align: center;\">sdfgdsf</p>\n<p style=\"text-align: center;\">dfg</p>\n<p style=\"text-align: center;\">dsfg</p>\n<p style=\"text-align: center;\">dsf</p>\n<p style=\"text-align: center;\">gs</p>\n<p style=\"text-align: center;\">dfg</p>\n<p style=\"text-align: center;\">dfg</p>\n<p style=\"text-align: center;\">dfsg</p>', '0', '195.69.221.118;127.0.0.10');

-- ----------------------------
-- Table structure for `be_WhereParam`
-- ----------------------------
DROP TABLE IF EXISTS `be_WhereParam`;
CREATE TABLE `be_WhereParam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fieldId` int(11) DEFAULT NULL,
  `viewId` int(11) NOT NULL DEFAULT '0',
  `fieldName` varchar(100) DEFAULT NULL,
  `whereName` varchar(255) DEFAULT NULL,
  `whereValue` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fieldId` (`fieldId`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of be_WhereParam
-- ----------------------------
INSERT INTO `be_WhereParam` VALUES ('1', '3', '1', 'NULL', 'viewType', '1,2');
INSERT INTO `be_WhereParam` VALUES ('2', '6', '2', '', 'viewType', '3,8');
INSERT INTO `be_WhereParam` VALUES ('3', '12', '4', '', 'viewId', '16');
INSERT INTO `be_WhereParam` VALUES ('15', '103', '19', '', 'listId', '1');
INSERT INTO `be_WhereParam` VALUES ('18', '127', '22', '', 'listId', '1');
INSERT INTO `be_WhereParam` VALUES ('19', '135', '23', '', 'listId', '1');
INSERT INTO `be_WhereParam` VALUES ('20', '230', '35', 'NULL', 'viewType', '1,2');
INSERT INTO `be_WhereParam` VALUES ('33', '17', '6', null, 'viewId', '8, 7');
INSERT INTO `be_WhereParam` VALUES ('41', '566', '20', null, 'listId', '2');
INSERT INTO `be_WhereParam` VALUES ('59', '911', '25', '', 'listId', '2');
INSERT INTO `be_WhereParam` VALUES ('60', '916', '26', '', 'listId', '1');
INSERT INTO `be_WhereParam` VALUES ('61', '925', '26', '', 'listId', '2');
INSERT INTO `be_WhereParam` VALUES ('66', '3', '1', null, 'active', '1');
INSERT INTO `be_WhereParam` VALUES ('67', '6', '2', null, 'active', '1');
INSERT INTO `be_WhereParam` VALUES ('90', '1943', '31', 'NULL', 'viewType', '1,2');
INSERT INTO `be_WhereParam` VALUES ('91', '1947', '31', '', 'viewId', '38');
INSERT INTO `be_WhereParam` VALUES ('99', '2231', '116', null, 'viewId', '8, 7');
INSERT INTO `be_WhereParam` VALUES ('100', '2317', '13', '', 'areaNumber', '1');
INSERT INTO `be_WhereParam` VALUES ('101', '2318', '13', '', 'areaNumber', '2');
INSERT INTO `be_WhereParam` VALUES ('102', '2320', '13', '', 'areaNumber', '9');
INSERT INTO `be_WhereParam` VALUES ('103', '2321', '13', '', 'areaNumber', '3');
INSERT INTO `be_WhereParam` VALUES ('104', '2322', '13', '', 'areaNumber', '4');
INSERT INTO `be_WhereParam` VALUES ('105', '2323', '13', '', 'areaNumber', '5');
INSERT INTO `be_WhereParam` VALUES ('106', '2324', '13', '', 'areaNumber', '6');
INSERT INTO `be_WhereParam` VALUES ('107', '2325', '13', '', 'areaNumber', '7');
INSERT INTO `be_WhereParam` VALUES ('108', '2326', '13', '', 'areaNumber', '8');
INSERT INTO `be_WhereParam` VALUES ('112', '2907', '18', null, 'listId', '1');
INSERT INTO `be_WhereParam` VALUES ('113', '2953', '85', '', 'listId', '1');
INSERT INTO `be_WhereParam` VALUES ('117', null, '86', '', 'listId', '1');
INSERT INTO `be_WhereParam` VALUES ('122', '3084', '21', '', 'listId', '1');
INSERT INTO `be_WhereParam` VALUES ('124', null, '87', '', 'listId', '1');
INSERT INTO `be_WhereParam` VALUES ('125', '3175', '45', '', 'viewId', '46');
INSERT INTO `be_WhereParam` VALUES ('128', '3236', '46', '', 'id', '15,20,25');
INSERT INTO `be_WhereParam` VALUES ('129', '3284', '44', '', 'viewId', '46');
INSERT INTO `be_WhereParam` VALUES ('131', '3313', '48', null, 'attributeId', '2');
INSERT INTO `be_WhereParam` VALUES ('132', '3314', '48', null, 'attributeId', '1');
INSERT INTO `be_WhereParam` VALUES ('133', '3316', '46', null, 'listId', '3');
INSERT INTO `be_WhereParam` VALUES ('134', '3479', '140', '', 'listId', '4');

-- ----------------------------
-- Table structure for `fe_Addresses`
-- ----------------------------
DROP TABLE IF EXISTS `fe_Addresses`;
CREATE TABLE `fe_Addresses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) unsigned DEFAULT NULL,
  `countryName` varchar(255) CHARACTER SET cp1251 DEFAULT NULL,
  `cityName` varchar(255) CHARACTER SET cp1251 DEFAULT NULL,
  `street` varchar(255) CHARACTER SET cp1251 DEFAULT NULL,
  `houseNumber` varchar(25) CHARACTER SET cp1251 DEFAULT NULL,
  `zipCode` varchar(20) CHARACTER SET cp1251 DEFAULT NULL,
  `name` varchar(255) CHARACTER SET cp1251 DEFAULT NULL,
  `surname` varchar(255) CHARACTER SET cp1251 DEFAULT NULL,
  `phoneNumber` varchar(20) CHARACTER SET cp1251 DEFAULT NULL,
  `gender` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_user_address` (`userId`),
  CONSTRAINT `fk_fe_Users_fe_Address` FOREIGN KEY (`userId`) REFERENCES `fe_Users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_Addresses
-- ----------------------------
INSERT INTO `fe_Addresses` VALUES ('13', '20', 'ukraine', 'zhitomir', 'shelushkova', '1', '12345', 'Karl', 'Kori', '0939944760', '1');
INSERT INTO `fe_Addresses` VALUES ('23', '20', 'ukraine', 'zhitomir', 'shelushkova', '1', '12345', 'Karl -shipping', 'Kori', '0939944760', '1');
INSERT INTO `fe_Addresses` VALUES ('24', '20', 'ukraine', 'zhitomir', 'shelushkova', '1', '12345', 'Karl - billing1', 'Kori', '0939944760', '1');
INSERT INTO `fe_Addresses` VALUES ('26', '20', 'ukraine', 'zhitomir', 'shelushkova', '33', '12345', 'Karl', 'Kori', '0939944760', '1');
INSERT INTO `fe_Addresses` VALUES ('32', '56', '', '', '', '', '', 'test', 'test', '', '1');
INSERT INTO `fe_Addresses` VALUES ('37', '70', '', '', '', '', '', '111', '111', '', '1');
INSERT INTO `fe_Addresses` VALUES ('38', '71', '', '', '', '', '', 'Max', 'Fighter', '', '1');
INSERT INTO `fe_Addresses` VALUES ('39', '71', '', '', '', '', '', 'Max2', 'Fighter1', '', '1');
INSERT INTO `fe_Addresses` VALUES ('50', '82', '', 'Zhitomir', 'Potapova', '', '87', 'Sergey', 'Kondratovec', '5833328', '1');
INSERT INTO `fe_Addresses` VALUES ('51', '82', '', 'Zhitomir', 'Potapova', '', '87', 'Sergey', 'Kondratovec', '5833328', '1');
INSERT INTO `fe_Addresses` VALUES ('53', '84', '', '', '', '', '', 'Eugeniyкууу', 'Derkachккккк', '', '1');
INSERT INTO `fe_Addresses` VALUES ('54', '84', '', '', 'uiuu', '', '', 'Eugeniyкууу', 'Derkachккккк', '', '1');
INSERT INTO `fe_Addresses` VALUES ('61', '91', '', '', '', '', '', 'eugen', 'derkach', '', '1');
INSERT INTO `fe_Addresses` VALUES ('62', '91', '', '', '', '', '', 'eugen', 'derkach', '', '2');
INSERT INTO `fe_Addresses` VALUES ('63', '91', '26', '16', 'gogolia6', '946', '', 'eugen6jhkhjkjhk', 'derkach6', '06873306096966ergerg', '2');
INSERT INTO `fe_Addresses` VALUES ('64', '91', '26', '16', 'gogolia6', '946', '', 'eugen', 'derkach', '06873306096966ergerg', '1');
INSERT INTO `fe_Addresses` VALUES ('65', '91', '26', '16', 'gogolia6', '946', '', 'eugen', 'derkach6', '06873306096966ergerg', '2');
INSERT INTO `fe_Addresses` VALUES ('66', '91', '26', '16', 'gogolia6', '946', '', 'eugenwwww', 'derkach6', '0687330609', '2');
INSERT INTO `fe_Addresses` VALUES ('67', '91', '26', '16', 'gogolia6', '946', '', 'eugenwwww', 'derkach3', '0687330609', '1');
INSERT INTO `fe_Addresses` VALUES ('68', '91', '26', '16', 'gogolia6', '946', '1111', 'eugenwwww', 'derkach6', '0687330609', '2');
INSERT INTO `fe_Addresses` VALUES ('69', '91', '267', '166', 'gogolia63', '9464', '5', 'eugen33', 'derkach62', '06873306099', '2');
INSERT INTO `fe_Addresses` VALUES ('70', '91', '267', '166', 'gogolia63', '9464', '5', 'eugen', 'derkach', '06873306099', '2');
INSERT INTO `fe_Addresses` VALUES ('71', '91', '267', '166', 'gogolia63', '9464', '5', 'eugen', 'derkach62', '06873306099', '2');
INSERT INTO `fe_Addresses` VALUES ('76', '98', '', '', '', '', '', 'Sergiy', 'Dragunov', '', '1');
INSERT INTO `fe_Addresses` VALUES ('77', '70', 'Nederland ', 'Schiedam', '1', '', '3128KG', 'Max', 'Melissen', '', '1');
INSERT INTO `fe_Addresses` VALUES ('78', '70', '', '', '', '', '', 'Max', 'Melissen', '', '1');
INSERT INTO `fe_Addresses` VALUES ('79', '98', 'dfgdfg', 'fgdg', 'fdsfsd', '', 'f2342', 'Sergiy', 'Dragunov', '23432423423', '1');
INSERT INTO `fe_Addresses` VALUES ('80', '99', 'Ukrain', 'Zhitomir', 'Narodychu', '1', '10031', 'Andrew', 'Grischuk', '', '1');
INSERT INTO `fe_Addresses` VALUES ('81', '100', 'zhi', 'zhi', 'zhi', '123', '123321', 'iwan', 'iwan', '1234356', '1');

-- ----------------------------
-- Table structure for `fe_BasketItems`
-- ----------------------------
DROP TABLE IF EXISTS `fe_BasketItems`;
CREATE TABLE `fe_BasketItems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pId` int(11) unsigned DEFAULT NULL,
  `productId` int(11) unsigned DEFAULT NULL,
  `variationId` int(11) unsigned DEFAULT NULL,
  `quantity` int(5) unsigned DEFAULT NULL,
  `pricePerProduct` decimal(10,2) unsigned DEFAULT NULL,
  `amount` decimal(10,2) unsigned DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `fk_fe_BasketItems_fe_Baskets` (`pId`),
  KEY `fk_product_basketitems` (`productId`),
  CONSTRAINT `fk_fe_BasketItems_fe_Baskets` FOREIGN KEY (`pId`) REFERENCES `fe_Baskets` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_basketitems` FOREIGN KEY (`productId`) REFERENCES `fe_Products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=216 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_BasketItems
-- ----------------------------
INSERT INTO `fe_BasketItems` VALUES ('72', '46', '27', '17', '2', '81.00', '162.00');
INSERT INTO `fe_BasketItems` VALUES ('134', '67', '27', '17', '2', '81.00', '162.00');
INSERT INTO `fe_BasketItems` VALUES ('201', '107', '25', '14', '1', '65.00', '65.00');
INSERT INTO `fe_BasketItems` VALUES ('204', '110', '27', '17', '3', '81.00', '243.00');
INSERT INTO `fe_BasketItems` VALUES ('207', '113', '25', '14', '3', '65.00', '195.00');
INSERT INTO `fe_BasketItems` VALUES ('208', '113', '25', '15', '4', '65.00', '260.00');
INSERT INTO `fe_BasketItems` VALUES ('209', '67', '27', '22', '1', '81.00', '81.00');
INSERT INTO `fe_BasketItems` VALUES ('210', '114', '37', '70', '1', '75.00', '75.00');
INSERT INTO `fe_BasketItems` VALUES ('211', '115', '27', '17', '1', '81.00', '81.00');
INSERT INTO `fe_BasketItems` VALUES ('212', '116', '37', '71', '20', '75.00', '1500.00');
INSERT INTO `fe_BasketItems` VALUES ('213', '117', '25', '13', '1', '65.00', '65.00');
INSERT INTO `fe_BasketItems` VALUES ('215', '119', '25', '15', '1', '65.00', '65.00');

-- ----------------------------
-- Table structure for `fe_Baskets`
-- ----------------------------
DROP TABLE IF EXISTS `fe_Baskets`;
CREATE TABLE `fe_Baskets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `viewId` int(11) unsigned NOT NULL DEFAULT '0',
  `userId` int(11) unsigned DEFAULT NULL,
  `itemsCount` int(3) unsigned NOT NULL DEFAULT '0',
  `totalPrice` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `createDate` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `shippingAddressId` int(11) unsigned DEFAULT NULL,
  `billingAddressId` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fe_Basket_fe_Users` (`userId`),
  KEY `fk_fe_Baskets_fe_Addresses` (`shippingAddressId`),
  KEY `fk_fe_Baskets_fe_Addresses2` (`billingAddressId`),
  CONSTRAINT `fk_fe_Baskets_fe_Addresses` FOREIGN KEY (`shippingAddressId`) REFERENCES `fe_Addresses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fe_Baskets_fe_Addresses2` FOREIGN KEY (`billingAddressId`) REFERENCES `fe_Addresses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fe_Basket_fe_Users` FOREIGN KEY (`userId`) REFERENCES `fe_Users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_Baskets
-- ----------------------------
INSERT INTO `fe_Baskets` VALUES ('44', '1', null, '0', '0.00', '2014-01-17 13:46:06', '2014-01-17 13:52:19', null, null);
INSERT INTO `fe_Baskets` VALUES ('46', '1', null, '2', '162.00', '2014-01-17 15:35:51', '2014-01-17 15:40:09', null, null);
INSERT INTO `fe_Baskets` VALUES ('51', '1', null, '0', '0.00', '2014-01-20 09:54:18', '2014-01-20 09:54:26', null, null);
INSERT INTO `fe_Baskets` VALUES ('61', '1', null, '0', '0.00', '2014-01-21 10:02:59', '2014-01-21 10:03:18', null, null);
INSERT INTO `fe_Baskets` VALUES ('67', '1', null, '3', '243.00', '2014-01-21 12:04:20', '2014-04-08 13:50:33', null, null);
INSERT INTO `fe_Baskets` VALUES ('79', '1', null, '0', '0.00', '2014-01-28 11:08:55', '2014-01-28 11:34:35', null, null);
INSERT INTO `fe_Baskets` VALUES ('80', '1', null, '0', '0.00', '2014-01-31 19:58:26', '2014-01-31 19:58:26', null, null);
INSERT INTO `fe_Baskets` VALUES ('107', '1', null, '1', '65.00', '2014-02-05 17:43:52', '2014-02-05 17:43:53', null, null);
INSERT INTO `fe_Baskets` VALUES ('110', '1', '70', '3', '243.00', '2014-02-27 12:18:52', '2014-02-27 12:20:22', '37', '37');
INSERT INTO `fe_Baskets` VALUES ('113', '1', '98', '7', '455.00', '2014-03-04 10:42:16', '2014-03-07 15:45:57', '76', '76');
INSERT INTO `fe_Baskets` VALUES ('114', '1', null, '1', '75.00', '2014-04-08 14:06:16', '2014-04-08 14:06:16', null, null);
INSERT INTO `fe_Baskets` VALUES ('115', '1', null, '1', '81.00', '2014-04-08 15:03:40', '2014-04-08 15:03:40', null, null);
INSERT INTO `fe_Baskets` VALUES ('116', '1', null, '20', '0.00', '2014-04-21 16:37:47', '2014-04-21 16:37:47', null, null);
INSERT INTO `fe_Baskets` VALUES ('117', '1', null, '1', '65.00', '2014-05-07 18:04:24', '2014-05-07 18:04:24', null, null);
INSERT INTO `fe_Baskets` VALUES ('119', '1', '100', '1', '65.00', '2014-07-14 16:44:35', '2014-07-14 16:47:01', '81', '81');

-- ----------------------------
-- Table structure for `fe_Comments`
-- ----------------------------
DROP TABLE IF EXISTS `fe_Comments`;
CREATE TABLE `fe_Comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contentId` int(10) unsigned DEFAULT NULL,
  `gameId` int(11) unsigned DEFAULT NULL,
  `userId` int(11) unsigned DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `text` varchar(1000) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approved` int(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Users_Comments` (`userId`),
  KEY `fk_pages_comments` (`contentId`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of fe_Comments
-- ----------------------------

-- ----------------------------
-- Table structure for `fe_MasterPages`
-- ----------------------------
DROP TABLE IF EXISTS `fe_MasterPages`;
CREATE TABLE `fe_MasterPages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `langId` int(10) unsigned DEFAULT NULL,
  `title` char(50) DEFAULT NULL,
  `viewId` int(10) unsigned NOT NULL,
  `relationId` char(36) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `websiteId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_website_masterpages` (`websiteId`),
  CONSTRAINT `fk_website_masterpages` FOREIGN KEY (`websiteId`) REFERENCES `be_WebSites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_MasterPages
-- ----------------------------
INSERT INTO `fe_MasterPages` VALUES ('16', '1', 'Головний шаблон (ua)', '13', 'ac213fda-d8ab-11e2-ae89-14dae997da6d', '1');
INSERT INTO `fe_MasterPages` VALUES ('17', '1', 'Головна сторінка', '13', '82c59132-3cf0-8770-d4ab-340c09b1208b', '1');
INSERT INTO `fe_MasterPages` VALUES ('22', '3', 'Головний шаблон (en)', '13', 'ac213fda-d8ab-11e2-ae89-14dae997da6d', '1');
INSERT INTO `fe_MasterPages` VALUES ('23', '3', 'Головна сторінка (en)', '13', '82c59132-3cf0-8770-d4ab-340c09b1208b', '1');
INSERT INTO `fe_MasterPages` VALUES ('24', '5', 'Головний шаблон (de)', '13', 'ac213fda-d8ab-11e2-ae89-14dae997da6d', '1');
INSERT INTO `fe_MasterPages` VALUES ('25', '5', 'Головна сторінка (de)', '13', '82c59132-3cf0-8770-d4ab-340c09b1208b', '1');
INSERT INTO `fe_MasterPages` VALUES ('26', '3', 'Сторінка категорії (en)', '13', '363a4ac8-d8b8-dbb7-8422-140cfa6fd821', '1');
INSERT INTO `fe_MasterPages` VALUES ('27', '4', 'Головний шаблон (nl)', '13', 'ac213fda-d8ab-11e2-ae89-14dae997da6d', '1');
INSERT INTO `fe_MasterPages` VALUES ('28', '6', 'Головний шаблон (fr)', '13', 'ac213fda-d8ab-11e2-ae89-14dae997da6d', '1');

-- ----------------------------
-- Table structure for `fe_MenuItems`
-- ----------------------------
DROP TABLE IF EXISTS `fe_MenuItems`;
CREATE TABLE `fe_MenuItems` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rootId` int(11) unsigned DEFAULT NULL,
  `parentId` int(11) unsigned DEFAULT NULL,
  `treeItemName` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `visible` tinyint(3) unsigned DEFAULT '1',
  `orderNumber` int(11) DEFAULT '1',
  `isTemp` binary(1) NOT NULL DEFAULT '1',
  `moduleId` int(11) unsigned NOT NULL DEFAULT '0',
  `imageActive` varchar(255) DEFAULT NULL,
  `imageInactive` varchar(255) DEFAULT NULL,
  `openLinkInNewWindow` int(11) NOT NULL,
  `websiteId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rootId` (`rootId`),
  KEY `parentId` (`parentId`),
  KEY `link_text` (`link`),
  KEY `fk_website_menuitems` (`websiteId`),
  CONSTRAINT `fk_website_menuitems` FOREIGN KEY (`websiteId`) REFERENCES `be_WebSites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of fe_MenuItems
-- ----------------------------
INSERT INTO `fe_MenuItems` VALUES ('1', '1', '0', 'Menu', '#', '1', '0', 0x30, '0', null, null, '0', '1');
INSERT INTO `fe_MenuItems` VALUES ('2', '1', '1', 'Головна', '{SITE_URL_PAGES}home.php?pagecode=home&lang=ua', '1', '1', 0x30, '0', '', '', '0', '1');
INSERT INTO `fe_MenuItems` VALUES ('3', '1', '1', 'Контакти', '#', '1', '2', 0x30, '0', '', '', '0', '1');
INSERT INTO `fe_MenuItems` VALUES ('5', '1', '1', 'Загальні новини', '{SITE_URL_PAGES}news_list.php?pagecode=zagalni-novini&lang=ua', '1', '3', 0x30, '0', '', '', '0', '1');
INSERT INTO `fe_MenuItems` VALUES ('6', '1', '1', 'Новини', '#', '1', '5', 0x30, '0', '', '', '0', '1');
INSERT INTO `fe_MenuItems` VALUES ('67', '67', '0', 'Menu', '#', '1', '0', 0x30, '0', '', '', '0', '1');
INSERT INTO `fe_MenuItems` VALUES ('68', '67', '67', 'Головна', '{SITE_URL_PAGES}home.php?pagecode=home&lang=en', '0', '2', 0x30, '0', '', '', '0', '1');
INSERT INTO `fe_MenuItems` VALUES ('69', '67', '67', 'Контакти', '#', '0', '3', 0x30, '0', '', '', '0', '1');
INSERT INTO `fe_MenuItems` VALUES ('76', '67', '67', 'Каталог', '#', '1', '1', 0x30, '3', '', '', '0', '1');
INSERT INTO `fe_MenuItems` VALUES ('83', '67', '67', 'Look Book', 'http://www.arefeva.eu/lookbook/index.html', '1', '4', 0x30, '0', '', '', '1', '1');
INSERT INTO `fe_MenuItems` VALUES ('87', '67', '67', 'Returnse/Exchanges', '{SITE_URL_PAGES}content.php?pagecode=returnsexchanges&lang=en', '0', '5', 0x30, '0', '', '', '0', '1');
INSERT INTO `fe_MenuItems` VALUES ('88', '67', '67', 'Shipment', '{SITE_URL_PAGES}content.php?pagecode=shipment&lang=en', '0', '6', 0x30, '0', '', '', '0', '1');
INSERT INTO `fe_MenuItems` VALUES ('89', '67', '67', 'Faq & Help', '{SITE_URL_PAGES}content.php?pagecode=faq--help&lang=en', '0', '7', 0x30, '0', '', '', '0', '1');
INSERT INTO `fe_MenuItems` VALUES ('90', '67', '67', 'Payment', '{SITE_URL_PAGES}content.php?pagecode=payment&lang=en', '0', '8', 0x30, '0', '', '', '0', '1');
INSERT INTO `fe_MenuItems` VALUES ('91', '67', '67', 'Search', '{SITE_URL_PAGES}search.php?pagecode=search&lang=en', '0', '9', 0x30, '0', '', '', '0', '1');
INSERT INTO `fe_MenuItems` VALUES ('92', '67', '67', 'Shopping cart', '{SITE_URL_PAGES}shoppingbag.php?pagecode=your-shoppingbag&lang=en', '0', '10', 0x30, '0', '', '', '0', '1');
INSERT INTO `fe_MenuItems` VALUES ('93', '67', '67', 'Sign in', '{SITE_URL_PAGES}signregister.php?pagecode=log-in&lang=en', '0', '11', 0x30, '0', '', '', '0', '1');
INSERT INTO `fe_MenuItems` VALUES ('94', '67', '67', 'Password recovery', '{SITE_URL_PAGES}passwd.php?pagecode=password-recovery&lang=en', '0', '12', 0x30, '0', '', '', '0', '1');

-- ----------------------------
-- Table structure for `fe_OrderItems`
-- ----------------------------
DROP TABLE IF EXISTS `fe_OrderItems`;
CREATE TABLE `fe_OrderItems` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pId` int(11) unsigned NOT NULL,
  `orderId` varchar(255) NOT NULL,
  `productId` int(11) unsigned DEFAULT NULL,
  `variationId` int(11) unsigned DEFAULT NULL,
  `quantity` int(5) unsigned DEFAULT NULL,
  `pricePerProduct` double(9,2) unsigned DEFAULT NULL,
  `amount` double(9,2) unsigned DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `pId` (`pId`),
  KEY `fk_product_orderitems` (`productId`),
  CONSTRAINT `fe_OrderItems_ibfk_1` FOREIGN KEY (`pId`) REFERENCES `fe_Orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_orderitems` FOREIGN KEY (`productId`) REFERENCES `fe_Products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_OrderItems
-- ----------------------------
INSERT INTO `fe_OrderItems` VALUES ('105', '1', 'dev_99_1404996040', '37', '74', '1', '75.00', '75.00');

-- ----------------------------
-- Table structure for `fe_Orders`
-- ----------------------------
DROP TABLE IF EXISTS `fe_Orders`;
CREATE TABLE `fe_Orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` varchar(255) NOT NULL,
  `viewId` int(11) unsigned NOT NULL DEFAULT '0',
  `userId` int(11) unsigned DEFAULT NULL,
  `itemsCount` int(3) unsigned NOT NULL DEFAULT '0',
  `orderPrice` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `deliveryPrice` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `totalPrice` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `createDate` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updateDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `orderStatusId` int(1) unsigned NOT NULL DEFAULT '1',
  `paymentStatusId` int(1) unsigned NOT NULL DEFAULT '1',
  `paymentMethodId` int(11) unsigned NOT NULL,
  `shippingAddressId` int(11) unsigned NOT NULL,
  `billingAddressId` int(11) unsigned NOT NULL,
  `paymentMethod` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fe_Orders_fe_Users` (`userId`),
  KEY `fk_fe_Orders_fe_OrderStatus` (`orderStatusId`),
  KEY `fk_fe_Orders_fe_PaymentStatus` (`paymentStatusId`),
  CONSTRAINT `fk_fe_Orders_fe_OrderStatus` FOREIGN KEY (`orderStatusId`) REFERENCES `fe_OrderStatus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fe_Orders_fe_PaymentStatus` FOREIGN KEY (`paymentStatusId`) REFERENCES `fe_PaymentStatus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fe_Orders_fe_Users` FOREIGN KEY (`userId`) REFERENCES `fe_Users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_Orders
-- ----------------------------
INSERT INTO `fe_Orders` VALUES ('1', 'dev_99_1404996040', '0', '99', '1', '75.00', '19.04', '94.04', '2014-07-10 16:40:40', '2014-07-14 16:44:00', '1', '1', '1', '80', '80', 'CreditCard');
INSERT INTO `fe_Orders` VALUES ('2', 'dev_99_1404996041', '0', '100', '1', '75.00', '19.04', '94.04', '2014-07-14 16:40:40', '2014-07-15 08:23:01', '3', '1', '1', '80', '80', 'CreditCard');

-- ----------------------------
-- Table structure for `fe_OrderStatus`
-- ----------------------------
DROP TABLE IF EXISTS `fe_OrderStatus`;
CREATE TABLE `fe_OrderStatus` (
  `id` int(11) unsigned NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_OrderStatus
-- ----------------------------
INSERT INTO `fe_OrderStatus` VALUES ('1', 'created');
INSERT INTO `fe_OrderStatus` VALUES ('2', 'paid');
INSERT INTO `fe_OrderStatus` VALUES ('3', 'in progress');
INSERT INTO `fe_OrderStatus` VALUES ('4', 'canceling');
INSERT INTO `fe_OrderStatus` VALUES ('5', 'returned');

-- ----------------------------
-- Table structure for `fe_OrderStatusHistory`
-- ----------------------------
DROP TABLE IF EXISTS `fe_OrderStatusHistory`;
CREATE TABLE `fe_OrderStatusHistory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` int(11) unsigned NOT NULL,
  `adminId` int(10) unsigned NOT NULL,
  `statusId` int(10) unsigned NOT NULL,
  `paymentStatusId` int(10) unsigned NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `orderId` (`orderId`),
  KEY `fe_OrderStatusHistory_fe_OrderStatus` (`statusId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_OrderStatusHistory
-- ----------------------------
INSERT INTO `fe_OrderStatusHistory` VALUES ('1', '1', '1', '4', '1', 'fuck off!', '2014-07-10 15:22:09');
INSERT INTO `fe_OrderStatusHistory` VALUES ('2', '1', '1', '4', '1', 'fuck off!', '2014-07-10 15:23:33');
INSERT INTO `fe_OrderStatusHistory` VALUES ('3', '1', '1', '2', '1', 'dsffsdfsdf', '2014-07-14 16:36:09');
INSERT INTO `fe_OrderStatusHistory` VALUES ('4', '1', '1', '3', '1', 'asdasd', '2014-07-14 16:37:45');
INSERT INTO `fe_OrderStatusHistory` VALUES ('5', '2', '1', '2', '1', 'the test', '2014-07-14 16:48:23');
INSERT INTO `fe_OrderStatusHistory` VALUES ('6', '2', '1', '3', '1', 'ura', '2014-07-15 08:23:01');

-- ----------------------------
-- Table structure for `fe_OrderStatusTranslations`
-- ----------------------------
DROP TABLE IF EXISTS `fe_OrderStatusTranslations`;
CREATE TABLE `fe_OrderStatusTranslations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `statusId` int(11) unsigned NOT NULL,
  `langId` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fe_OrderStatusTranslation_fe_OrderStatus` (`statusId`),
  CONSTRAINT `fk_fe_OrderStatusTranslation_fe_OrderStatus` FOREIGN KEY (`statusId`) REFERENCES `fe_OrderStatus` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_OrderStatusTranslations
-- ----------------------------
INSERT INTO `fe_OrderStatusTranslations` VALUES ('1', '1', '3', 'not paid');
INSERT INTO `fe_OrderStatusTranslations` VALUES ('2', '1', '4', 'not paid');
INSERT INTO `fe_OrderStatusTranslations` VALUES ('3', '1', '5', 'not paid');
INSERT INTO `fe_OrderStatusTranslations` VALUES ('4', '2', '3', 'paid');
INSERT INTO `fe_OrderStatusTranslations` VALUES ('5', '2', '4', 'paid');
INSERT INTO `fe_OrderStatusTranslations` VALUES ('6', '2', '5', 'paid');
INSERT INTO `fe_OrderStatusTranslations` VALUES ('8', '3', '3', 'in progress');
INSERT INTO `fe_OrderStatusTranslations` VALUES ('9', '3', '4', 'in progress');
INSERT INTO `fe_OrderStatusTranslations` VALUES ('10', '3', '5', 'in progress');
INSERT INTO `fe_OrderStatusTranslations` VALUES ('11', '4', '3', 'canceled');
INSERT INTO `fe_OrderStatusTranslations` VALUES ('12', '4', '4', 'canceled');
INSERT INTO `fe_OrderStatusTranslations` VALUES ('13', '4', '5', 'canceled');
INSERT INTO `fe_OrderStatusTranslations` VALUES ('15', '5', '3', 'returned');
INSERT INTO `fe_OrderStatusTranslations` VALUES ('16', '5', '4', 'returned');
INSERT INTO `fe_OrderStatusTranslations` VALUES ('17', '5', '5', 'returned');

-- ----------------------------
-- Table structure for `fe_PageObjectsInAreas`
-- ----------------------------
DROP TABLE IF EXISTS `fe_PageObjectsInAreas`;
CREATE TABLE `fe_PageObjectsInAreas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `masterPageId` int(10) unsigned NOT NULL,
  `areaNumber` int(10) unsigned DEFAULT NULL,
  `pageObjectId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `iu_fe_PageObjectsInAreas_mpId_areaNum_poId` (`masterPageId`,`areaNumber`,`pageObjectId`),
  KEY `fk_pageObject_Masterpage` (`pageObjectId`),
  CONSTRAINT `fk_masterPage_Pageobjects` FOREIGN KEY (`masterPageId`) REFERENCES `fe_MasterPages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pageObject_Masterpage` FOREIGN KEY (`pageObjectId`) REFERENCES `fe_Pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15350 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_PageObjectsInAreas
-- ----------------------------
INSERT INTO `fe_PageObjectsInAreas` VALUES ('14861', '16', '1', '8563');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('14860', '16', '9', '2');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('14859', '16', '9', '203');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('14884', '17', '1', '2033');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('14882', '17', '1', '8563');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('14883', '17', '1', '8568');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('14886', '17', '7', '8574');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('14881', '17', '9', '2');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('14880', '17', '9', '203');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15335', '22', '1', '8732');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15334', '22', '1', '8771');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15339', '22', '2', '8707');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15336', '22', '2', '8768');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15338', '22', '2', '8770');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15337', '22', '2', '8789');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15340', '22', '7', '8706');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15341', '22', '8', '8729');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15342', '22', '8', '8764');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15333', '22', '9', '8702');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15332', '22', '9', '8703');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15345', '23', '1', '8730');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15346', '23', '1', '8732');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15347', '23', '7', '8706');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15348', '23', '8', '8729');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15349', '23', '8', '8764');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15344', '23', '9', '8702');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15343', '23', '9', '8703');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15156', '24', '1', '8706');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15155', '24', '1', '8732');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15154', '24', '1', '8771');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15160', '24', '2', '8707');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15157', '24', '2', '8768');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15158', '24', '2', '8769');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15159', '24', '2', '8770');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15161', '24', '7', '8729');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15153', '24', '9', '8702');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15152', '24', '9', '8703');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('14931', '25', '1', '8706');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('14929', '25', '1', '8730');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('14930', '25', '1', '8732');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('14932', '25', '7', '8729');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('14933', '25', '7', '8764');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('14928', '25', '9', '8702');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('14927', '25', '9', '8703');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15324', '26', '1', '8732');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15323', '26', '1', '8771');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15328', '26', '2', '8707');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15325', '26', '2', '8768');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15327', '26', '2', '8770');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15326', '26', '2', '8789');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15329', '26', '7', '8706');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15330', '26', '8', '8729');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15331', '26', '8', '8764');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15321', '26', '9', '203');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15322', '26', '9', '8702');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15260', '27', '1', '8732');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15259', '27', '1', '8771');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15264', '27', '2', '8707');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15261', '27', '2', '8768');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15263', '27', '2', '8770');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15262', '27', '2', '8789');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15265', '27', '7', '8706');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15266', '27', '8', '8729');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15267', '27', '8', '8764');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15258', '27', '9', '8702');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15257', '27', '9', '8703');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15271', '28', '1', '8732');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15270', '28', '1', '8771');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15275', '28', '2', '8707');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15272', '28', '2', '8768');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15274', '28', '2', '8770');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15273', '28', '2', '8789');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15276', '28', '7', '8706');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15277', '28', '8', '8729');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15278', '28', '8', '8764');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15269', '28', '9', '8702');
INSERT INTO `fe_PageObjectsInAreas` VALUES ('15268', '28', '9', '8703');

-- ----------------------------
-- Table structure for `fe_Pages`
-- ----------------------------
DROP TABLE IF EXISTS `fe_Pages`;
CREATE TABLE `fe_Pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `langId` int(10) unsigned NOT NULL DEFAULT '0',
  `websiteId` int(11) unsigned NOT NULL,
  `relationId` char(36) DEFAULT NULL,
  `viewId` int(11) unsigned DEFAULT NULL,
  `codeName` varchar(255) DEFAULT NULL,
  `masterPageId` int(10) unsigned NOT NULL,
  `seoTitle` varchar(100) DEFAULT NULL,
  `seo1` varchar(255) DEFAULT NULL,
  `seo2` varchar(255) NOT NULL,
  `visible` tinyint(3) DEFAULT '1',
  `introHtml` text,
  `outroHtml` text,
  `title` varchar(255) DEFAULT NULL,
  `html` text NOT NULL,
  `shortDescription` varchar(255) DEFAULT NULL,
  `dateStartVisible` timestamp NULL DEFAULT NULL,
  `dateEndVisible` timestamp NULL DEFAULT NULL,
  `text1` varchar(255) NOT NULL,
  `text2` varchar(255) NOT NULL,
  `text3` varchar(255) NOT NULL,
  `text4` varchar(255) NOT NULL,
  `text5` varchar(255) DEFAULT NULL,
  `text6` text,
  `text7` varchar(255) DEFAULT NULL,
  `text8` varchar(255) DEFAULT NULL,
  `text9` varchar(255) DEFAULT NULL,
  `text10` varchar(255) DEFAULT NULL,
  `number1` int(11) unsigned DEFAULT NULL,
  `number2` int(11) unsigned DEFAULT NULL,
  `number3` int(11) NOT NULL,
  `number4` int(11) NOT NULL,
  `number5` int(11) DEFAULT NULL,
  `number6` int(11) unsigned DEFAULT NULL,
  `number7` int(10) unsigned DEFAULT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codeName` (`codeName`,`langId`,`websiteId`),
  KEY `langId` (`langId`),
  KEY `viewId` (`viewId`),
  KEY `websiteId` (`websiteId`),
  CONSTRAINT `fk_languages_pages` FOREIGN KEY (`langId`) REFERENCES `be_Languages` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_view_pages` FOREIGN KEY (`viewId`) REFERENCES `be_View` (`viewId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_website_pages` FOREIGN KEY (`websiteId`) REFERENCES `be_WebSites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8822 DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of fe_Pages
-- ----------------------------
INSERT INTO `fe_Pages` VALUES ('2', '1', '1', 'd4f6aa12-b143-11e0-a6ce-001517dedd18', '16', null, '0', '', null, '', '1', null, null, 'Головний CSS && JS', '<link href=\"{SITE_URL}/frontend/webcontent/css/general.css\" type=\"text/css\" rel=\"stylesheet\" /><script type=\"text/javascript\" src=\"{SITE_URL}/frontend/webcontent/js/general.js\"></script>', null, null, null, '', '', '', '', '', null, null, null, null, null, null, null, '0', '0', null, null, null, '2012-05-07 08:20:12');
INSERT INTO `fe_Pages` VALUES ('26', '3', '1', '0', '30', null, '0', '', '', '', '1', null, null, 'Дерево каталогу', '', null, null, null, '', '', '', '', '', null, null, null, null, null, null, '1', '0', '0', null, null, null, '2014-02-12 17:10:38');
INSERT INTO `fe_Pages` VALUES ('27', '1', '1', '7520f22e-b0a2-321b-042c-d254b0b57711', '6', null, '0', null, null, '', '1', null, null, 'Меню на сторінку каталогу', '', null, null, null, 'templates/PageObjects/LeftMenu.tpl', '', '', '', null, null, null, null, null, null, '2031', null, '0', '0', null, null, null, '2013-07-15 11:48:02');
INSERT INTO `fe_Pages` VALUES ('203', '1', '1', 'd4f6c6dc-b143-11e0-a6ce-001517dedd18', '16', null, '0', '', '', '', '1', null, null, 'jquery-1.9.1.min', '<script type=\"text/javascript\" src=\"{SITE_URL}/frontend/webcontent/js/jquery-1.9.1.min.js\"></script>', null, null, null, '', '', '', '', '', null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-06-18 15:23:52');
INSERT INTO `fe_Pages` VALUES ('404', '1', '1', 'd4f73586-b143-11e0-a6ce-001517dedd18', '108', '404', '1', 'На жаль, запитувана сторінка не знайдена.', '', '', '1', null, null, 'Хм... сторінка, яку ви шукаєте, не може бути знайдена.', '<p style=\"font-size: 80px; color: red;\">\n	404\n</p>\n<p>\n	Ви ввели не вірну адресу, або така сторінка вже не існує.\n</p>\n<p>\n	Повернутися на <a href=\"/\">головну</a> сторінку.\n</p>', null, null, null, '', '', '', '', '', null, null, null, null, null, null, null, '0', '0', null, null, null, '2012-02-19 10:26:24');
INSERT INTO `fe_Pages` VALUES ('2033', '1', '1', 'accb5452-9905-11e1-b696-14dae997da6d', '6', null, '0', null, null, '', '1', null, null, 'Головне меню', '', null, null, null, 'templates/PageObjects/HeaderMenu.tpl', '', '', '', null, null, null, null, null, null, '2031', null, '0', '0', null, null, null, '2012-05-08 12:02:25');
INSERT INTO `fe_Pages` VALUES ('2035', '1', '1', 'f1c7301e-e617-ae93-935c-1f6aa187df09', '34', null, '0', null, null, '', '1', null, null, 'Форма авторизації', '', '', null, null, 'Вхід', '{SITE_URL_PAGES}register.php?pagecode=registration&lang=ua', 'E-mail:', 'Пароль:', 'Готово', '{SITE_URL_PAGES}passwd.php?pagecode=nagaduvannya-parolyu&lang=ua', '#', 'Вийти', '{SITE_URL_PAGES}privateOffice.php?pagecode=osobistiy-kabinet&lang=ua', null, null, null, '0', '0', null, null, null, '2012-04-06 12:07:59');
INSERT INTO `fe_Pages` VALUES ('8522', '1', '1', 'ba413c5e-45c9-1153-412d-4f2540a9a1bd', '18', 'news_page1', '16', '', '', '', '1', null, null, 'news_page1', '<span style=\"color: rgb(0, 0, 0);\">Вниманию житомирских участников дорожного движения. Штормовое предупреждение!\n\nПо информации Гидрометцентра,<a href=\"http://ukr.net\" target=\"_blank\">23-25 марта</a> , в связи с перемещением в Украину активного циклона с Балкан, в Житомире ожидаются очень сложные погодные условия.\n\nЖитомирская ГАИ просит водителей в ближайшие два дня не садиться за руль в связи с существенным ухудшением погодных условий.\n\nТак, <a href=\"http://www.\" target=\"_blank\">link</a> в Житомире и других северных районах, а также в Винницкой и Черкасской областях сильные, местами очень сильные снегопады, сильные метели, снежные заносы. В Одесской, Кировоградской, Полтавской и Харьковской областях сильный дождь и мокрый снег; местами налипание мокрого снега, гололед, на дорогах гололедица.\n\nНа остальной территории сильные дожди, 23 марта с переходом в мокрый снег, в Украине, кроме крайнего запада, усиление скорости ветра до 17-22 м/с.\n\nГАИ обращается к водителям с просьбой во время осложнения погодных условий по возможности воздержаться от поездок на собственном транспорте. Если же все-таки выехать крайне необходимо, будьте особенно внимательными и осторожными за рулем, неуклонно придерживайтесь Правил дорожного движения.\n\nПроверьте техническое состояние автомобиля, пользуйтесь ремнями безопасности, не превышайте скорость, соблюдайте безопасную дистанцию и правила парковки (чтобы не мешать работе снегоуборочной техники). С особой осторожностью двигайтесь по мостам и эстакадам, откажитесь от рискованных маневрирований. В условиях недостаточной видимости, тумана, сильного снегопада или дождя, двигайтесь с включенным ближним светом фар или противотуманными фонарями.\n\nЕсли во время движения вы увидели, что кто-то попал в затруднительное положение из-за непогоды, призовите на помощь ГАИ или аварийные службы.\n\nНе забывайте следить за сообщением в СМИ о состоянии проезда по дорогам страны.</span>', '<b>Житомир накроет новая волна похолодания. В город вернутся метели и морозы</b>', '2013-03-21 16:19:00', null, '', '{SITE_URL}/frontend/webcontent/file/news_page1.jpg', '', '', '', '', '', '', '', '', '1', null, '0', '0', null, null, null, '2013-03-22 17:44:58');
INSERT INTO `fe_Pages` VALUES ('8523', '1', '1', 'b170daef-d521-f0f5-a916-aac578bd5bc3', '18', 'news_page2', '16', '', '', '', '1', null, null, 'news_page2', '<span style=\"color: rgb(0, 0, 0);\">При покупке нового автомобиля жители Житомира и области чаще всего выбирают недорогие седаны.\n\nОб этом Авто Журналу сообщает пресс-служба портала по продаже авто RST.ua\n\nСогласно данным продаж и регистрации ТС, в феврале в житомирских автосалонах чаще других пользовались спросом автомобили с кузовом седан. Их продажи составили 46% от общего количества купленных за месяц новых легковых авто.\n\n18% автопродаж пришлось на хетчбэки, 4% - это универсалы, 32% - внедорожники и кроссоверы.\n\nВ ценовых сегментах наибольший спрос был у автомобилей стоимостью до 17 тысяч долларов. Их доля продаж в житомирских автосалонах в феврале составила 48%. Машины от 17 до 35 тысяч показали результат в 42%, остальные 10% пришлись на премиум и люкс класс свыше 35 тысяч долларов.\n\nВсего же за месяц жители Житомира и области купили 165 новых легковых авто и потратили на них почти 3,5 миллиона долларов.\n\nПо брендам роли распределись следующим образом.\n\nБольше всего в феврале в Житомирской области было продано автомобилей марки ЗАЗ, при этом украинские авто заняли 32% рынка в своем сегменте, на втором месте ВАЗ с 27% продаж в своем сегменте. Третья позиция с меньшим количеством продаж в абсолютном значении, но при этом с долей в 29% в своем классе, находится Ford.\n\nНапомним, всего в феврале украинцы купили 13,5 тысяч новых легковых авто, на которые потратили более 340 миллионов долларов.</span>', '<h2>В феврале жители Житомира и области купили 165 новых легковых авто</h2>', '2013-03-21 16:29:00', null, '', '', '{SITE_URL}/frontend/webcontent/file/250%20(7).jpg', '', '', '', '', '', '', '', '1', null, '0', '0', null, null, null, '2013-03-22 16:37:43');
INSERT INTO `fe_Pages` VALUES ('8524', '1', '1', 'faf02b07-affc-57dc-dcd6-9749e6710688', '18', 'news_page3', '16', '', '', '', '1', null, null, 'news_page3', '<p><span style=\"color: green;\">Прокуратура Житомирской области советует работникам Житомирского ТТУ отстаивать в суде свое право получать заработную плату вовремя.   Как сообщили &laquo;Журналу Житомира&raquo; в пресс-службе прокуратуры Житомира, в результате совместной с территориальной инспекцией по вопросам труда проверки соблюдения законодательства об оплате труда служебными лицами КП &quot;ЖТТУ&quot;, было выявлено ряд нарушений. </span></p>\n<p>&nbsp;</p>\n<p><span style=\"color: green;\"> В ходе проверки установлено нарушение требований законодательства по своевременной выплате заработной платы.  По состоянию на 1 марта 2013 работникам ТТУ задолжали 3 млн. 53 тыс. грн. зарплаты.  На имя Житомирского городского головы внесено представление с требованием принять действенные меры по координации деятельности предприятия.  По результатам рассмотрения представления создана рабочая группа с привлечением специалистов облгосадминистрации, которая должна предоставить предложения по оптимизации материальных затрат и изыскания резервов увеличения доходов КП &laquo;ЖТТУ&raquo;, эффективного использования фонда оплаты труда и оптимизации транспортной сети.  Кроме этого, по результатам проверки инспекцией по труду внесено предписание начальнику предприятия по соблюдению требований законодательства об оплате труда.  Также председателям профсоюзов и работникам ТТУ предоставлено разъяснение относительно их прав на обращение в прокуратуру и представительства интересов граждан в суде.  Однако, пока что таких обращений от работников ТТУ в прокуратуру не поступало.  Напомним, сегодня, 21 марта, работники трамвайно-троллейбусного управления собрались на акцию протеста у стен Житомирского областного совета на площади Королева с требованием погасить долги по зарплате.  Как информирует сайт Житомир Инфо, около 50 человек пришли на митинг к зданию облсовета на площади Королева,1.  Митингующее требовали не уничтожать электротранспорт и выплатить долги по зарплате.  Также, представители профсоюза пытались попасть в сессионный зал, чтобы пообщаться со слугами народа, однако, председатель облсовета Запаловский предложил выступать председателю независимого профсоюза работников Житомирского ТТУ на сессии городского, а не областного совета.  На сессии губернатор Сергей Рыжук и председатель облсовета Иосиф Запаловский говорили о том, что деньги из областного бюджета Житомирскому ТТУ выделять не будут, т.к. это должно делать государство.  - Пусть сначала государство отдаст, а потом мы поможем, - сказал Сергей Рыжук.</span></p>', '<h3>Работникам житомирского ТТУ посоветовали добиватся выплаты зарплаты в суде, а не на митинге</h3>', '2013-03-21 16:33:00', null, '', '', '', '', '', '', '', '', '', '{SITE_URL}/frontend/webcontent/file/250%20(7).jpg', '1', null, '0', '0', null, null, null, '2013-03-22 17:44:45');
INSERT INTO `fe_Pages` VALUES ('8525', '1', '1', '26044fdd-94e8-b0a0-7862-5126aa1aa4cc', '19', 'futbolni-novunu', '16', '', '', '', '1', 'Текст вступноъ частини', null, 'Футбольні новини', '', null, null, null, '', '', '', '', null, null, null, null, null, null, '1', '2', '0', '0', null, null, null, '2013-03-28 16:27:33');
INSERT INTO `fe_Pages` VALUES ('8526', '1', '1', '55b9438d-11d7-e3bc-0b29-c686339aeb7e', '18', 'prodavaya-svadebnoe-plate-cherez-internet-zhitomiryane-postradali-ot-moshennikov', '16', '', '', '', '1', null, null, 'Продавая свадебное платье через интернет житомиряне пострадали от мошенников', 'Молодые супруги из Житомира пострадали от мошенничества в Интернете.\n\nКак стало известно «Журналу Житомира», сразу после свадьбы супруги решили продать свадебное платье. Разместили соответствующее объявление в интернет, где указали номер мобильного телефона девушки.\n\nЧерез некоторое время позвонила незнакомка, которая уточнив размер, фасон, другие детали, заверила молодую девушку, что свадебное платье ей подходит, и она готова его купить. Оплату проведет безналично, поэтому просит указать номер счета, на который необходимо внести средства.\n\nСупруги, без сомнения, сообщили незнакомке дополнительные данные, как и просила покупательница, и стали ждать перечисления средств. Однако, через несколько дней узнали, что с их счета снято около 2 тысяч гривен.\n\n - Такая схема является банальным мошенничеством, которое в последнее время приобретает все большее распространение, - прокомментировал ситуацию начальник сектора борьбы с киберпреступностью УМВД Украины в Житомирской области Евгений Ходаковский. - Ни при каких обстоятельствах, ни под каким предлогом не следует сообщать собственные персональные данные кому-либо, а тем более малознакомым людям.\n\nВпрочем, возможность продать или купить товар на досках объявлений в интернет ежедневно завоевывает все больше сторонников. Это быстро, выгодно и удобно, к тому же, часто дешевле, чем в обычном магазине. Однако не следует забывать, что такая форма ведения или домашней бухгалтерии, то бизнеса требует определенных знаний и умений, и определенного опыта и коммуникативных навыков.\n\nВладелец одного из предприятий, житель Житомирщины, воспользовавшись возможностями Интернета, решил купить авто у фирмы, зарегистрированной на территории другой области.\n\nМужчина позвонил продавцу, пообщался с ним и на платежную карту через терминал заплатил почти 5 тысяч гривен якобы за транспортные услуги и предоплату.\n\nИзлишне, наверное, говорить, что после уплаты суммы виртуальный партнер перестал выходить на связь, и никоим образом не контактировал с предпринимателем, кстати, знакомым лишь заочно.\n\n - Такие действия классифицируются Уголовным кодексом Украины как мошенничество с использованием компьютеров. И в отличие от других схем мошенничества, всевозможных порч, гаданий и т.д., достаточно строго наказываются лишением свободы на срок от 3 до 8 лет, - продолжает Ходаковский.\n\nПравоохранители уверяют, что Интернет не сможет скрыть личности виртуального мошенника. Технические возможности и налаженные механизмы взаимодействия с провайдерами позволяют отслеживать и устанавливать данные нечестных пользователей паутины, а следовательно и привлекать их к ответственности за обман людей.\n\nВпрочем, вот несколько практических советов, соблюдение которых поможет вам уберечься от неприятных неожиданностей:\nНе оставляйте на сайтах, в том числе социальных сетях, а также при проведении покупок конфиденциальной информации о себе и своих банковских карточках.\nДля онлайн-покупки через Интернет лучше использовать отдельно заведенные карточки.\nПри открытии счетов в банковских учреждениях лучше использовать контрактные номера мобильной связи. Это значительно уменьшит шансы доступа мошенников к вашему счету.\nНикому ни при каких обстоятельствах не сообщайте ПИН-код, пароли, коды доступа к своим счетам и любую информацию, которая приходит на ваш мобильный телефон в виде SMS-сообщений из банка. Работники банков не проводят такие операции по телефону.\nТолько ваша внимательность и бдительность убережет вас от мошенников.', 'Молодые супруги из Житомира пострадали от мошенничества в Интернете.\n\nКак стало известно «Журналу Житомира», сразу после свадьбы супруги решили продать свадебное платье. Разместили соответствующее объявление в интернет, где указали номер мобильного телефо', '2013-03-22 17:35:00', null, '', '', '', '', '', '', '', '', '', '', '2', null, '0', '0', null, null, null, '2013-03-22 17:45:04');
INSERT INTO `fe_Pages` VALUES ('8527', '1', '1', '2a13f825-9659-6d42-ff04-829315b41c9f', '19', 'zagalni-novini', '16', '', '', '', '1', '', null, 'Загальні новини', '', null, null, null, '', '', '', '', null, null, null, null, null, null, '2', '2', '0', '0', null, null, null, '2013-03-28 16:37:53');
INSERT INTO `fe_Pages` VALUES ('8529', '1', '1', 'e5ea28d3-8ddd-b759-1042-dfc67a21a9d4', '18', 'pod-zhitomirom-avtomobili-vytaskivayut-tankami-foto', '16', '', '', '', '1', null, null, 'Под Житомиром автомобили вытаскивают танками. ФОТО', '<span style=\"color: rgb(0, 0, 0);\">\nВ Житомирской области сложилась более сложная, чем в остальных областях ситуация в связи со снегопадами и снежными заносами.\n\nВ области в усиленном режиме работают кроме спасателей ГСЧС, специалисты Минобороны и облавтодора.\n \nВ настоящее время наихудшая ситуация сложилась в Бердичевском, Брусиловском, Ружинском, Коростышевском и Попельнянском районах, по территории которых проходят дороги государственного значения, где соответственно есть большая нагрузка автотранспорта.\n\nСложные участки автодорог, как показывает практика, вблизи села Хажин, Бердичевского района и села Белиловка, Ружинского района.\n \nВ настоящее время, для оказания помощи и проведения неотложных работ привлечены силы и средства Управления ГСЧС (100 человек личного состава и 36 единиц техники), Министерства обороны (12 человек личного состава и 6 единиц техники) и облавтодора (147 человек и 100 единиц техники).\n \nНепосредственно подразделениями Управления ГСЧС 22-23 марта было изъято 119 единиц транспорта из снежных заносов. Из которых 14 карет скорой помощи и один школьный автобус с детьми и один рейсовый. Также, было доставлено 2 больных и одну роженицу в районные больницы.\n \nСпасателями обеспечена доставка в населенные пункты 18 человек, которые находились в заметенных автомобилях. 23 марта пожарным автомобилем доставлялась бригада РЭС для устранения порывов на линиях электропередач в поселке Корнин.\n \nВсего по Житомирской области функционирует 67 стационарных пунктов обогрева. Но учитывая крайне сложную ситуацию, связанную с большим затором на автодороге Киев - Чоп, и с целью предупреждения случаев переохлаждения, силами Управления ГСЧС в селах Гадзинка, Житомирского района и Ставище, Брусиловского района, развернуто 2 стационарные палатки для обогрева, питания и предоставления первой медицинской помощи водителям и пассажирам автомобилей, а также обеспечено круглосуточное посменное дежурство личного состава.</span>', '\n\nВ Житомирской области сложилась более сложная, чем в остальных областях ситуация в связи со снегопадами и снежными заносами.\n\nВ области в усиленном режиме работают кроме спасателей ГСЧС, специалисты Минобороны и облавтодора.', '2013-03-25 12:04:00', null, '', '', '', '', '', '', '', '', '', '', '2', null, '0', '0', null, null, null, '2013-03-25 12:04:32');
INSERT INTO `fe_Pages` VALUES ('8530', '1', '1', 'a1efa150-06de-828e-fe85-80646bf642c5', '18', 'zhitomir-prodolzhaet-borotsya-so-snegopadami-ostanovlen-odin-trolleybusnyy-marshrut', '16', '', '', '', '1', null, null, 'Житомир продолжает бороться со снегопадами. Остановлен один троллейбусный маршрут', '<span style=\"color: rgb(0, 0, 0);\">23 марта, за прошедшие 12 часов, в Житомире выпало более месячной нормы осадков. В городе наблюдаются сугробы высотой до 1,5-1,8 метра.\n\nПо словам комунальщиков, в городе всю ночь работала снегоуборочная техника. Техника Водоканала очищала от снега районы Корбутовка и Малеванка, а техника Теплокоммунэнерго - Центр и Полевую.\n\nИз-за сложных погодных условий в Житомире создан оперативный штаб.\n\nИз общественного транспорта, остановлен один троллейбусный маршрут в направлении Черняховского моста. Все трамваи ездят с 10.00. Продолжается активная очистка трамвайных путей.\n\nИз-за сложных погодных условий по улице Московской произошел порыв водоводов (порыв трубы диаметром 300 мм). На месте аварии всю ночь работали рабочие и техника КП «Житомирводоканал». До 5:30 час. утра авария была ликвидирована.\n\n\nВИДЕО: Снегоочистительная техника стоит в сугробах\n\n\nПо информации из оперативного штаба, с 5 до 10 часов утра на придомовых территориях работало 468 дворников. Техника работает в круглосуточном режиме, меняются только водители. Дворники будут сегодня выходить на снегоуборочные работы с 14.00. (II смена) и с 19.30 ОГД. (III смена).\n\nВ свою очередь, мэр Житомира, который координирует работу оперативного штаба, выступил с инициативой премировать людей, работающих в сложных погодных условиях всю ночь.\n\nПо прогнозам Житомирского областного центра гидрометеорологии, 23-25 ??марта ожидаются сильные метели, снежные заносы, порывы ветра 17-25 м/с.\n\nЖитомирян просят без необходимости не выходить на улицу, а водителям не оставлять свои авто на обочине дорог, ведь это будет мешать работе снегоуборочной техники.\n\nВ случае возникновения сложной или чрезвычайной ситуации звоните по телефону круглосуточной линии 15-80.</span>', '23 марта, за прошедшие 12 часов, в Житомире выпало более месячной нормы осадков. В городе наблюдаются сугробы высотой до 1,5-1,8 метра.', '2013-03-25 12:05:00', null, '', '', '', '', '', '', '', '', '', '', '2', null, '0', '0', null, null, null, '2013-03-25 12:06:04');
INSERT INTO `fe_Pages` VALUES ('8531', '1', '1', '4d4bcb2f-7bfc-30e9-1b72-2b4a2777ed81', '19', 'novoni', '16', '', '', '', '1', '', null, 'Новони', '', null, null, null, '', '', '', '', null, null, null, null, null, null, '0', '1', '0', '0', null, null, null, '2013-03-25 12:13:51');
INSERT INTO `fe_Pages` VALUES ('8532', '1', '1', 'bd80a22e-5dba-ebf9-0b80-02a877633c6d', '18', 'sneg-v-zhitomire-ubirayut-no-ne-vyvozyat', '16', '', '', '', '1', null, null, 'Снег в Житомире убирают, но не вывозят', '<span style=\"color: rgb(0, 0, 0);\">Сегодня в Житомире коммунальные службы продолжают расчищать город от снега.\n\nК сожалению, дороги и пешеходные тротуары пока только чистят, но снег не вывозят. Из-за чего на обочинах выросли двухметровые сугробы.\n\n<a href=\"http://zhzhitomir.at.ua/_ph/1/2/97798881.jpg\" target=\"_blank\">link</a>Как сообщили «Журналу Житомира» в штабе, который координирует работу по уборке города от снега, коммунальная техника работает круглосуточно.\n\n - На работу вышли 51 единица техники, 24 из которых прочищают придомовые территории. - говорит начальник управления коммунального хозяйства Александр Марцун, - Особенностью нынешнего мартовского снегопада является высокая влажность. Снег на дорогах сразу превращается в лед, что затрудняет уборку.\n\nСегодня коммунальные службы города сосредоточили внимание на второстепенных улицах и придомовых территориях. На улицах города: 5 подметальных машин, 6 подметальных тракторов, 2 автогрейдера, 5 пескоразбрасывателей, 2 бульдозера, 2 экскаватора, 5 тракторов с передним плугом.\n\nПо состоянию на 24.03.2013 года использовано 620 тонн песчано-солевой смеси.\n\n\nВИДЕО: Пассажиры толкают троллейбусы\n\n\nНа сегодня движение транспорта, в том числе общественного, на главных, магистральных улицах Житомире обеспечено. Сейчас основной задачей остается расчистка второстепенных улиц, обеспечивающих в микрорайонах свободное передвижение транспорта.\n\n - На данный основное внимание сосредоточено на придомовых территориях, чтобы люди смогли вовремя и беспрепятственно добраться на работу. Подходы к учреждениям, офисам, все тротуары должны быть расчищены. Коммунальные предприятия в полном объеме обеспечены необходимыми горюче-смазочными материалами и объемами песчано-солевой смеси, - заметил Николай Боровец.\n\nНа придомовых территориях и других объектах благоустройства задействовано 20 подметальных тракторов и 4 трактора с передним плугом. На уборку тротуаров и придомовых территорий вышли 348 дворников.<img src=\"http://zhzhitomir.at.ua/_ph/1/2/239649268.jpg\" />\n\nКак сообщалось, вчера рота курсантов житомирского военного института восстанавливала движение трамваев в Житомире.\n</span>', 'Сегодня в Житомире коммунальные службы продолжают расчищать город от снега.\n\nК сожалению, дороги и пешеходные тротуары пока только чистят, но снег не вывозят. Из-за чего на обочинах выросли двухметровые сугробы.', '2013-03-25 12:16:00', null, '', '', '', '', '', '', '', 'Картинки 1', 'Евгеній', '', '0', null, '0', '0', null, null, null, '2013-03-26 17:14:29');
INSERT INTO `fe_Pages` VALUES ('8535', '1', '1', 'a1dba35c-88b8-9793-6615-bb3dd0e92f74', '18', 'zhizn-bez-boli--eto-vash-vybor', '16', '', '', '', '1', null, null, 'Жизнь без боли – это Ваш выбор!', 'Неврологические заболевания значительно снижают качество жизни, поскольку сопровождаются болью, нарушением подвижности и памяти. Чаще всего эти заболевания прогрессируют очень быстро, и поэтому принципиальным является своевременное обращение к врачу-неврологу. Опытный невролог уже на ранней стадии заболевания обнаружит имеющиеся нарушения нервной системы, подберет эффективное лечение, остановит развитие болезни и вылечит пациента.\n\nНа самые распространенные вопросы наших читателей отвечает Щербина Татьяна Николаевна – врач-невролог медицинского центра «Медибор», которая имеет 28-летний опыт работы в неврологии.\n\nТатьяна Николаевна, с какими проблемами чаще всего к Вам обращаются пациенты?\n\nСамой распространенной причиной обращения к врачу не только в неврологической, но и во всей медицинской практике, является головная боль. Периодически ее испытывает более 75% населения Украины, при этом большинство людей принимает анальгетики, даже не попытавшись разобраться в причинах этой боли. Головная боль может быть симптомом примерно 50 различных заболеваний. Поэтому если такая боль беспокоит вас больше чем 4 раза в месяц, вам необходима консультация невролога с целью установления причины боли и быстрой ликвидации заболевания.', 'Современный ритм жизни предъявляет повышенные требования к нашему организму и, в первую очередь, к нервной системе. ', '2013-03-27 11:04:00', null, '', '', '', '', '', '', '', '', '', '', '2', null, '0', '0', null, null, null, '2013-03-27 11:05:29');
INSERT INTO `fe_Pages` VALUES ('8536', '1', '1', 'a318f282-86b6-bcb7-4835-928c73281fbd', '85', 'ofisnyy-sotrudnik-v-otdel-kontaktov', '16', '', '', '', '1', null, null, 'Офисный сотрудник в отдел контактов', 'Требования:\n\n    свободное владение русским и украинским языком;\n    умение чётко и грамотно говорить;\n    отсутствие дефектов речи;\n    ответственность;\n    пунктуальность.\n\nКомпания предлагает:\n\n    работа в комфортном офисе;\n    обучение, тренинги за счёт компании;\n    профессиональный карьерный рост;\n    своевременную З/П;\n    гибкий график работы (полная/неполная занятость).\n\nКонтактное лицо: Елена 050 355 82 25.\n\n \n\nКонтактное лицо: Елена\n\nТелефон: 0503558225', 'Требуется офисный сотрудник в отдел контактов.\n\nДолжностные обязанности:\n\nназначение встреч по телефону.', '2013-03-28 10:07:00', null, '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', null, null, null, '2013-03-28 10:08:31');
INSERT INTO `fe_Pages` VALUES ('8538', '1', '1', '396bc66d-30a2-3413-5ccf-66cae71a137b', '85', 'front-end-developer', '16', '', '', '', '1', null, null, 'Front-End Developer', 'Успішні кандидати повинні відповідати таким необхідних компетенцій / навичок:\n\n     Великий досвід в HTML, CSS, JavaScript, jQuery.\n     Здатність виробляти Valid HTML / CSS код відповідно до даної документацією.\n     Хороші навички спілкування в усній та письмовій англійської.\n     Знання ASP.NET MVC є сильною перевагою.\n     MS / ступінь бакалавра в галузі комп\'ютерних наук, ІТ або його еквівалент.\n\n \n\nЩоб дізнатися більше про Інфопульс Україна й інші переваги, будь ласка, см.: http://www.infopulse.com.ua/rus/vacancies/welcome', 'Infopulse Ukraine welcomes talented professionals to join our new project as Front-End Developer(Code: FED 110) in Kiev/ Vinnytsia/ Zhytomyr.', '2013-03-28 10:13:00', null, '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', null, null, null, '2013-03-28 10:14:18');
INSERT INTO `fe_Pages` VALUES ('8552', '1', '1', '76a336f3-da73-0805-06e1-673cbec35023', '86', 'vakansiyi', '16', '', '', '', '1', 'Вакансія - вільний', null, 'Вакансії', '', null, null, null, '', '', '', '', null, null, null, null, null, null, null, '4', '0', '0', null, null, null, '2013-03-29 16:13:57');
INSERT INTO `fe_Pages` VALUES ('8554', '1', '1', 'ef54eb73-499a-ef02-554f-46238b8a6247', '85', 'operacionnyy-direktor', '16', '', '', '', '1', null, null, 'Операционный директор', 'Обязанности:\n\n    Создание технологий взаимодействия с бизнесом заказчиков, проектирование скриптов для работы операторов, контроль за эффективностью и юзабилити существующих программ;\n    Интегрирование работы call-центра с существующими технологиями и бизнес-процессами, как внутри организации, так и на стороне заказчика;\n    Анализ проекта и корректирование работы подразделений call-центра для решения задач заказчиков;\n    Инициирование разработки новых инструментов мониторинга.\n    Написание ТЗ.\n\nТребования:\n\n    Высшее техническое образование;\n    Опыт написания технических требований, технических заданий, функционально-логических схем;\n    Владение способами формализации и презентации алгоритмов;\n    Знание Excel, Visio и PowerPoint, опыт подготовки презентаций;\n    Коммуникабельность, активность, энергичность;\n    Грамотная устная и письменная речь;\n    Знание Английского языка на уровне.\n\nУсловия:\n\n    Официальное трудоустройство, социальный пакет;\n    Конкурентоспособная заработная плата;\n    Перспективы карьерного роста.\n', 'Требования к соискателю\n\n    опыт работы от 2 лет\n    высшее образование\n', '2013-03-28 14:11:00', null, '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', null, null, null, '2013-03-28 14:11:51');
INSERT INTO `fe_Pages` VALUES ('8555', '1', '1', '212105bf-6e8e-8925-5db1-a74026832da1', '87', 'za-yakist-produkciyi', '16', null, null, '', '1', null, null, 'За якість продукції', 'Положенням «Про державні нагороди Української РСР», що діяло на момент проголошення незалежності України, було встановлено, що державними нагородами Української РСР є почесні звання Української РСР («Народний артист Української РСР», «Народний художник Української РСР», «Народний архітектор Української РСР» та 26 почесних звань категорї «Заслужений»), Почесна Грамота і Грамота Президії Верховної Ради Української РСР.[2]. Також за станом на 1991 рік в УРСР присуджувалися Державні премії Української РСР в галузі науки і техніки та за видатні досягнення у праці і науково-технічній творчості; Державна премія Української РСР імені Т. Г. Шевченка в галузі літератури, журналістики і мистецтва; Державна премія Української РСР по архітектурі.\n\nЗаконом України «Про внесення змін і доповнень до Конституції (Основного Закону) України» від 14 лютого 1992 р. в Конституцію (Основний Закон) України 1978 р. була внесена норма, згідно з якою Президент України засновує президентські відзнаки і нагороджує ними (ст. 114-5). Згідно з Конституцією України 1996 р., Президент України нагороджує державними нагородами, встановлює президентські відзнаки та нагороджує ними (ст. 106); разом із тим, установлено, що державні нагороди встановлюються виключно законами України (ст. 92).\n\nПрезиденти України Л. М. Кравчук та Л. Д. Кучма своїми Указами встановлювали відзнаки Президента України та нагороджували ними.\n\nПерші запроваджені відзнаки — Почесна відзнака Президента України (1992) та відзнаки Президента України «За мужність» — зірка «За мужність» і хрест «За мужність» (1995) — у 1996 році були замінені новими відзнаками Президента України — орденами «За заслуги» та «За мужність»; при цьому нагороджені визнавалися кавалерами відповідних орденів зі збереженням права на носіння вручених їм відзнак.\n\nБули також запроваджені відзнаки Президента України — «Іменна вогнепальна зброя», «Орден Богдана Хмельницького», «Орден князя Ярослава Мудрого» (1995), медаль «За військову службу Україні», медаль «За бездоганну службу» (1996), «Орден княгині Ольги» (1997), «Герой України» (з врученням ордена «Золота Зірка» або ордена Держави) (1998), Почесна Грамота Президента України за активну благодійницьку діяльність у гуманітарній сфері, почесне звання «Заслужений лісівник України», медаль «Захиснику Вітчизни», почесне звання «Заслужений працівник соціальної сфери України» (1999).\n\nТакож Указом Президента України Л. М. Кравчука 1993 року було засновано пам\'ятний знак «50 років визволення України», нагородження яким було проведено Указом Президента України Л. Д. Кучми у 1994 р.', 'Державні нагороди України — вища форма відзначення громадян України за видатні заслуги у розвитку економіки, науки, культури, соціальної сфери, захисті', null, null, '{SITE_URL}/frontend/webcontent/images/250%20(1).jpg', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-04-01 11:33:36');
INSERT INTO `fe_Pages` VALUES ('8557', '1', '1', '79443be0-f88c-ba10-7f0c-2b86752dfc15', '87', 'za-vidvagu', '16', null, null, '', '1', null, null, 'За відвагу', '	У 2013 році компанія «Ернст енд Янг» в Україні стала переможцем конкурсу «Благодійна Україна» серед великих компаній. Багаторічна програма «Дружба», представлена на конкурс, описує комплекс ініцатив на підтримку дітей-сиріт, що передбачає волонтерські поїздки до дітей, спільні заходи, тренінги та майстерні від співробітників, залучення дітей до розвиваючих програм та підтримку студентів-сиріт.\n«Ернст енд Янг» в Україні стала переможницею конкурсу «Корпоративне волонтерство 2012» в номінації «Освіта» за програму для студентів «Крок у майбутнє». Конкурс було організовано Фондом Східна Європа, Глобальним Договором ООН в Україні, Американською торгівельною палатою, Європейською Бізнес Асоціацією та Українським Форумом Благодійників.\nКомпанія «Ернст енд Янг» отримала золоту премію «HR-БРЕНД Україна 2012» в номинації «Столиця» - за програму Wellness, спрямовану на вирівнювання балансу між роботою та особистим життям співробітників (комплекс заходів, спрямованих на підтримку здорового і активного способу життя та розкриття інтелектуального потенціалу). «HR-БРЕНД» - це незалежна щорічна премія за найбільш успішну роботу з репутацією компанії як роботодавця, заснована групою компаній HeadHunter (hh.ru).', 'Нагороди для «Ернст енд Янг» в Україні:', null, null, '{SITE_URL}/frontend/webcontent/images/250%20(20).jpg', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-04-01 11:53:32');
INSERT INTO `fe_Pages` VALUES ('8558', '1', '1', '9eb3885c-94bc-0682-5755-09395a24c393', '87', 'za-muzhnist', '16', null, null, '', '1', null, null, 'За мужність', 'зайняв почесне шістнадцяте місце рейтингу «ТОП-100. Кращі топ-менеджери України» серед керівників юридичних компаній. Основними критеріями при формуванні рейтингу стали: репутація топ-менеджера і його авторитет серед колег, наявність чіткої стратегії розвитку та позитивна динаміка розвитку бізнесу.\n\nЕкспертами при складанні рейтингу виступили керівники компаній різних галузей, які оцінили один одного в своїх сегментах ринку. За допомогою оцінок топ-менеджерами своїх колег-конкурентів складаються галузеві рейтинги і загальний рейтинг (ТОП-100) менеджерів.\n\nРейтинг «ТОП-100. Кращі топ-менеджери України», складений тижневиком «ІнвестГазета», опублікований в журналі «ТОП-100. Рейтинг кращих компаній України». ', 'Керуючий партнер Юридичної Фірми «АС Консалтинг» ', null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-04-01 10:13:08');
INSERT INTO `fe_Pages` VALUES ('8559', '1', '1', '169a1a83-fedc-3b1c-81dc-71fa37d0e7e8', '87', 'sertifikat-yakosti-produkciyi', '16', null, null, '', '1', null, null, 'Сертифікат якості продукції', 'Всеукраїнського конкурсу якості продукції «100 кращих товарів України»', 'Переможець регіонального етапу ', null, null, '{SITE_URL}/frontend/webcontent/images/250%20(20).jpg', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-04-01 11:41:11');
INSERT INTO `fe_Pages` VALUES ('8560', '1', '1', '2d87b5df-cf43-7718-1301-1f322dcd2e4f', '87', 'peremozhec-litnogo-chempionatu-soccer-land-z-mini-futbolu-u-vischiy-lizi-2009-roku', '16', null, null, '', '1', null, null, ' Переможець літнього чемпіонату «Soccer-Land» з міні-футболу у вищій лізі 2009 року;', 'Також, компанія «ДЕН» займається розвитком своїх працівників не тільки у професійній сфері, але і в підтримці корпоративної культури, участю в різних соціальних і благодійних проектах. Наша соціальна активність була високо оцінена, за що ми й отримали нагороду від центру «Розвитку КСВ» за кращий бізнес-кейс у сфері корпоративної соціальної відповідальності.', 'компанія «ДЕН» займається розвитком своїх працівників', null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-04-01 10:18:18');
INSERT INTO `fe_Pages` VALUES ('8561', '1', '1', '6ea1df81-352e-5124-c988-d93be8a3f7ad', '39', 'poshuk', '16', null, '', '', '1', 'Пошук', null, 'Пошук', '', null, null, null, 'не знайдено', 'ок', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-04-05 17:42:10');
INSERT INTO `fe_Pages` VALUES ('8563', '1', '1', '154a491c-fb90-a114-73ba-af5d7b88b26e', '15', null, '0', null, null, '', '1', null, null, 'Головний логотип', '', null, null, null, '{SITE_URL}/frontend/webcontent/images/logo.jpg', 'Dream Blouses', '#', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-06-18 11:32:16');
INSERT INTO `fe_Pages` VALUES ('8565', '1', '1', '7dfdc469-9966-59ba-16e4-455a8f935dda', '14', null, '0', null, null, '', '1', null, null, 'Слоган сайту', '<img class = \"slogan\" src=\"{SITE_URL}/frontend/webcontent/images/slogan.png\" alt=\"\" />', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-04-08 13:57:53');
INSERT INTO `fe_Pages` VALUES ('8568', '1', '1', 'd32c96a8-78f4-ce6c-a2d7-bb3f57b5c861', '62', null, '0', null, null, '', '1', null, null, 'Вибір мови', '', null, null, null, '', '', '', '', null, null, null, null, null, null, '1', null, '0', '0', null, null, null, '2013-04-08 16:11:06');
INSERT INTO `fe_Pages` VALUES ('8569', '1', '1', '634af085-e0df-9050-253b-d9ff1a735aeb', '14', null, '0', null, null, '', '1', null, null, 'Логотип_слоган', '<div class=\"logo_slogan\">\n<div class=\"smoll_logo\"><img src=\"{SITE_URL}/frontend/webcontent/images/smoll_logo.png\" alt=\"\" /></div>\n<div class=\"slogan_smoll\"><img alt=\"\" src=\"{SITE_URL}/frontend/webcontent/images/slogan_smoll.png\" /></div>\n</div>', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-04-09 14:16:03');
INSERT INTO `fe_Pages` VALUES ('8570', '1', '1', '576923ec-68e7-8b23-d62b-b8d54f652246', '14', null, '0', null, null, '', '1', null, null, ' Торгова марка “Руден”', '<div>&copy; Торгова марка &ldquo;Руден&rdquo; 2007-2013</div>', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-04-08 18:02:47');
INSERT INTO `fe_Pages` VALUES ('8572', '1', '1', '77c31a24-d05e-4379-35f7-7b6682e2f44b', '14', null, '0', null, null, '', '1', null, null, 'Футер-меню', '<ul class=\"footer_menu\">\n<li>\n<a href=\"{SITE_URL}/ua/home/home.htm\">Головна</a>\n</li>\n<li>\n<a href=\"{SITE_URL}/ua/home/home.htm\">Продукція</a>\n</li>\n<li>\n<a href=\"{SITE_URL}/ua/home/home.htm\">Дистриб\'юція</a>\n</li>\n<li>\n<a href=\"{SITE_URL}/ua/home/home.htm\">Новини</a>\n</li>\n<li>\n<a href=\"{SITE_URL}/ua/home/home.htm\">Рецепти</a>\n</li>\n<li>\n<a href=\"{SITE_URL}/ua/home/home.htm\">Торгівля</a>\n</li>\n<li>\n<a href=\"{SITE_URL}/ua/home/home.htm\">Партнери</a>\n</li>\n<li>\n<a href=\"{SITE_URL}/ua/vacancy_list/vakansiyi.htm\">Вакансії</a>\n</li>\n<li>\n<a href=\"{SITE_URL}/ua/home/home.htm\">Контакти</a>\n</li>\n</ul>', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-04-11 12:36:01');
INSERT INTO `fe_Pages` VALUES ('8574', '1', '1', 'a7715e75-f8cf-48d0-61fa-2132de8a0dc6', '14', null, '0', null, null, '', '1', null, null, 'Футер-соц.сети', '<div class=\"join-and-follow minimized\">\n                <a class=\"join-and-follow-header\" href=\"#\">JOIN OUR <span class=\"newsletter-text\">NEWSLETTER</span>\n                </a>\n                <p class=\"join-block-text\">\n                    Keep up to date with the lastest Dream Blouses news!\n                </p>\n                <div class=\"join-block\">\n                    <input type=\"text\" placeholder=\"Your email\" class=\"mail-input\" />\n                    <a class=\"join-button brown\">JOIN</a>\n                </div>\n                <div class=\"horizontal-line brown\">\n                </div>\n                <div class=\"followUs-block\">\n                    FOLLOW US\n                    <div class=\"social-button facebook\">\n                    </div>\n                    <div class=\"social-button twitter\">\n                    </div>\n                    <div class=\"social-button google\">\n                    </div>\n                </div>\n                <div class=\"copyright\">\n                    © AREFEVA, 2013\n                </div>\n            </div>\n<script type=\"text/javascript\">		    \n            $(\'.join-and-follow-header\').click(function () { var toogleBlock = $(\'.join-and-follow\'); if (toogleBlock.hasClass(\'minimized\')) toogleBlock.removeClass(\'minimized\'); else toogleBlock.addClass(\'minimized\'); });\n        </script>', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-06-18 16:46:13');
INSERT INTO `fe_Pages` VALUES ('8701', '3', '1', 'd4f6a5e4-b143-11e0-a6ce-001517dedd18', '21', 'home', '23', '', '', '', '1', '', null, 'Main page', ' ', '', '2013-03-21 16:19:00', null, 'Новости', 'Первичное жилье', '', '{SITE_URL_PAGES}primaryHousing_list.php?id=105', '', '', '', '', '', '', '3', null, '4', '0', null, null, null, '2013-09-27 12:18:46');
INSERT INTO `fe_Pages` VALUES ('8702', '3', '1', 'd4f6aa12-b143-11e0-a6ce-001517dedd18', '16', null, '0', '', null, '', '1', null, null, 'Головний CSS && JS', '<link href=\"{SITE_URL}/frontend/webcontent/css/general.css\" type=\"text/css\" rel=\"stylesheet\" />\n<link href=\"{SITE_URL}/frontend/webcontent/css/validationEngine.jquery.css\" type=\"text/css\" rel=\"stylesheet\" />\n<script type=\"text/javascript\" src=\"{SITE_URL}/frontend/webcontent/js/general.js\"></script>\n<script type=\"text/javascript\" src=\"{SITE_URL}/frontend/webcontent/js/formValidation/jquery.validationEngine.js\"></script>\n<script type=\"text/javascript\" src=\"{SITE_URL}/frontend/handlers/FormValidationRulesController.php\"></script>', null, null, null, '', '', '', '', '', null, null, null, null, null, null, null, '0', '0', null, null, null, '2014-03-20 17:23:59');
INSERT INTO `fe_Pages` VALUES ('8703', '3', '1', 'd4f6c6dc-b143-11e0-a6ce-001517dedd18', '16', null, '0', '', '', '', '1', null, null, 'jquery-1.9.1.min', '<script type=\"text/javascript\" src=\"{SITE_URL}/frontend/webcontent/js/jquery-1.9.1.min.js\"></script>', null, null, null, '', '', '', '', '', null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-08-16 15:41:20');
INSERT INTO `fe_Pages` VALUES ('8704', '3', '1', 'd4f73586-b143-11e0-a6ce-001517dedd18', '108', '404', '1', 'На жаль, запитувана сторінка не знайдена.', '', '', '1', null, null, 'Хм... сторінка, яку ви шукаєте, не може бути знайдена.', '<p style=\"font-size: 80px; color: red;\">\n	404\n</p>\n<p>\n	Ви ввели не вірну адресу, або така сторінка вже не існує.\n</p>\n<p>\n	Повернутися на <a href=\"/\">головну</a> сторінку.\n</p>', null, null, null, '', '', '', '', '', null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8705', '3', '1', '65699145-4c5c-ecba-560a-5801784accf6', '8', null, '0', null, null, '', '1', null, null, 'Main menu', '', null, null, null, '', '', '', '', null, null, null, null, null, null, '7', '67', '0', '0', null, null, null, '2013-08-30 12:18:21');
INSERT INTO `fe_Pages` VALUES ('8706', '3', '1', 'accb5452-9905-11e1-b696-14dae997da6d', '6', null, '0', null, null, '', '1', null, null, 'Головне меню', '', null, null, null, 'templates/PageObjects/HeaderMenu.tpl', '', '', '', null, null, null, null, null, null, '8705', null, '0', '0', null, null, null, '2013-06-19 12:40:34');
INSERT INTO `fe_Pages` VALUES ('8707', '3', '1', 'f1c7301e-e617-ae93-935c-1f6aa187df09', '34', null, '0', null, null, '', '1', null, null, 'Форма авторизації', '', '', null, null, 'Вхід', '{SITE_URL_PAGES}register.php?pagecode=registration&lang=ua', 'E-mail:', 'Пароль:', 'Готово', '{SITE_URL_PAGES}passwd.php?pagecode=nagaduvannya-parolyu&lang=ua', '#', 'Вийти', '{SITE_URL_PAGES}privateOffice.php?pagecode=osobistiy-kabinet&lang=ua', null, null, null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8708', '3', '1', 'ba413c5e-45c9-1153-412d-4f2540a9a1bd', '18', 'news_page1', '22', '', '', '', '1', null, null, 'news_page1', '<span style=\"color: rgb(0, 0, 0);\">Вниманию житомирских участников дорожного движения. Штормовое предупреждение!\n\nПо информации Гидрометцентра,<a href=\"http://ukr.net\" target=\"_blank\">23-25 марта</a> , в связи с перемещением в Украину активного циклона с Балкан, в Житомире ожидаются очень сложные погодные условия.\n\nЖитомирская ГАИ просит водителей в ближайшие два дня не садиться за руль в связи с существенным ухудшением погодных условий.\n\nТак, <a href=\"http://www.\" target=\"_blank\">link</a> в Житомире и других северных районах, а также в Винницкой и Черкасской областях сильные, местами очень сильные снегопады, сильные метели, снежные заносы. В Одесской, Кировоградской, Полтавской и Харьковской областях сильный дождь и мокрый снег; местами налипание мокрого снега, гололед, на дорогах гололедица.\n\nНа остальной территории сильные дожди, 23 марта с переходом в мокрый снег, в Украине, кроме крайнего запада, усиление скорости ветра до 17-22 м/с.\n\nГАИ обращается к водителям с просьбой во время осложнения погодных условий по возможности воздержаться от поездок на собственном транспорте. Если же все-таки выехать крайне необходимо, будьте особенно внимательными и осторожными за рулем, неуклонно придерживайтесь Правил дорожного движения.\n\nПроверьте техническое состояние автомобиля, пользуйтесь ремнями безопасности, не превышайте скорость, соблюдайте безопасную дистанцию и правила парковки (чтобы не мешать работе снегоуборочной техники). С особой осторожностью двигайтесь по мостам и эстакадам, откажитесь от рискованных маневрирований. В условиях недостаточной видимости, тумана, сильного снегопада или дождя, двигайтесь с включенным ближним светом фар или противотуманными фонарями.\n\nЕсли во время движения вы увидели, что кто-то попал в затруднительное положение из-за непогоды, призовите на помощь ГАИ или аварийные службы.\n\nНе забывайте следить за сообщением в СМИ о состоянии проезда по дорогам страны.</span>', '<b>Житомир накроет новая волна похолодания. В город вернутся метели и морозы</b>', '2013-03-21 16:19:00', null, '', '{SITE_URL}/frontend/webcontent/file/news_page1.jpg', '', '', '', '', '', '', '', '', '1', null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8709', '3', '1', 'b170daef-d521-f0f5-a916-aac578bd5bc3', '18', 'news_page2', '22', '', '', '', '1', null, null, 'news_page2', '<span style=\"color: rgb(0, 0, 0);\">При покупке нового автомобиля жители Житомира и области чаще всего выбирают недорогие седаны.\n\nОб этом Авто Журналу сообщает пресс-служба портала по продаже авто RST.ua\n\nСогласно данным продаж и регистрации ТС, в феврале в житомирских автосалонах чаще других пользовались спросом автомобили с кузовом седан. Их продажи составили 46% от общего количества купленных за месяц новых легковых авто.\n\n18% автопродаж пришлось на хетчбэки, 4% - это универсалы, 32% - внедорожники и кроссоверы.\n\nВ ценовых сегментах наибольший спрос был у автомобилей стоимостью до 17 тысяч долларов. Их доля продаж в житомирских автосалонах в феврале составила 48%. Машины от 17 до 35 тысяч показали результат в 42%, остальные 10% пришлись на премиум и люкс класс свыше 35 тысяч долларов.\n\nВсего же за месяц жители Житомира и области купили 165 новых легковых авто и потратили на них почти 3,5 миллиона долларов.\n\nПо брендам роли распределись следующим образом.\n\nБольше всего в феврале в Житомирской области было продано автомобилей марки ЗАЗ, при этом украинские авто заняли 32% рынка в своем сегменте, на втором месте ВАЗ с 27% продаж в своем сегменте. Третья позиция с меньшим количеством продаж в абсолютном значении, но при этом с долей в 29% в своем классе, находится Ford.\n\nНапомним, всего в феврале украинцы купили 13,5 тысяч новых легковых авто, на которые потратили более 340 миллионов долларов.</span>', '<h2>В феврале жители Житомира и области купили 165 новых легковых авто</h2>', '2013-03-21 16:29:00', null, '', '', '{SITE_URL}/frontend/webcontent/file/250%20(7).jpg', '', '', '', '', '', '', '', '1', null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8710', '3', '1', 'faf02b07-affc-57dc-dcd6-9749e6710688', '18', 'news_page3', '22', '', '', '', '1', null, null, 'news_page3', '<p><span style=\"color: green;\">Прокуратура Житомирской области советует работникам Житомирского ТТУ отстаивать в суде свое право получать заработную плату вовремя.   Как сообщили &laquo;Журналу Житомира&raquo; в пресс-службе прокуратуры Житомира, в результате совместной с территориальной инспекцией по вопросам труда проверки соблюдения законодательства об оплате труда служебными лицами КП &quot;ЖТТУ&quot;, было выявлено ряд нарушений. </span></p>\n<p>&nbsp;</p>\n<p><span style=\"color: green;\"> В ходе проверки установлено нарушение требований законодательства по своевременной выплате заработной платы.  По состоянию на 1 марта 2013 работникам ТТУ задолжали 3 млн. 53 тыс. грн. зарплаты.  На имя Житомирского городского головы внесено представление с требованием принять действенные меры по координации деятельности предприятия.  По результатам рассмотрения представления создана рабочая группа с привлечением специалистов облгосадминистрации, которая должна предоставить предложения по оптимизации материальных затрат и изыскания резервов увеличения доходов КП &laquo;ЖТТУ&raquo;, эффективного использования фонда оплаты труда и оптимизации транспортной сети.  Кроме этого, по результатам проверки инспекцией по труду внесено предписание начальнику предприятия по соблюдению требований законодательства об оплате труда.  Также председателям профсоюзов и работникам ТТУ предоставлено разъяснение относительно их прав на обращение в прокуратуру и представительства интересов граждан в суде.  Однако, пока что таких обращений от работников ТТУ в прокуратуру не поступало.  Напомним, сегодня, 21 марта, работники трамвайно-троллейбусного управления собрались на акцию протеста у стен Житомирского областного совета на площади Королева с требованием погасить долги по зарплате.  Как информирует сайт Житомир Инфо, около 50 человек пришли на митинг к зданию облсовета на площади Королева,1.  Митингующее требовали не уничтожать электротранспорт и выплатить долги по зарплате.  Также, представители профсоюза пытались попасть в сессионный зал, чтобы пообщаться со слугами народа, однако, председатель облсовета Запаловский предложил выступать председателю независимого профсоюза работников Житомирского ТТУ на сессии городского, а не областного совета.  На сессии губернатор Сергей Рыжук и председатель облсовета Иосиф Запаловский говорили о том, что деньги из областного бюджета Житомирскому ТТУ выделять не будут, т.к. это должно делать государство.  - Пусть сначала государство отдаст, а потом мы поможем, - сказал Сергей Рыжук.</span></p>', '<h3>Работникам житомирского ТТУ посоветовали добиватся выплаты зарплаты в суде, а не на митинге</h3>', '2013-03-21 16:33:00', null, '', '', '', '', '', '', '', '', '', '{SITE_URL}/frontend/webcontent/file/250%20(7).jpg', '1', null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8711', '3', '1', '26044fdd-94e8-b0a0-7862-5126aa1aa4cc', '19', 'futbolni-novunu', '22', '', '', '', '1', 'Текст вступноъ частини', null, 'Футбольні новини', '', null, null, null, '', '', '', '', null, null, null, null, null, null, '1', '2', '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8712', '3', '1', '55b9438d-11d7-e3bc-0b29-c686339aeb7e', '18', 'prodavaya-svadebnoe-plate-cherez-internet-zhitomiryane-postradali-ot-moshennikov', '22', '', '', '', '1', null, null, 'Продавая свадебное платье через интернет житомиряне пострадали от мошенников', 'Молодые супруги из Житомира пострадали от мошенничества в Интернете.\n\nКак стало известно «Журналу Житомира», сразу после свадьбы супруги решили продать свадебное платье. Разместили соответствующее объявление в интернет, где указали номер мобильного телефона девушки.\n\nЧерез некоторое время позвонила незнакомка, которая уточнив размер, фасон, другие детали, заверила молодую девушку, что свадебное платье ей подходит, и она готова его купить. Оплату проведет безналично, поэтому просит указать номер счета, на который необходимо внести средства.\n\nСупруги, без сомнения, сообщили незнакомке дополнительные данные, как и просила покупательница, и стали ждать перечисления средств. Однако, через несколько дней узнали, что с их счета снято около 2 тысяч гривен.\n\n - Такая схема является банальным мошенничеством, которое в последнее время приобретает все большее распространение, - прокомментировал ситуацию начальник сектора борьбы с киберпреступностью УМВД Украины в Житомирской области Евгений Ходаковский. - Ни при каких обстоятельствах, ни под каким предлогом не следует сообщать собственные персональные данные кому-либо, а тем более малознакомым людям.\n\nВпрочем, возможность продать или купить товар на досках объявлений в интернет ежедневно завоевывает все больше сторонников. Это быстро, выгодно и удобно, к тому же, часто дешевле, чем в обычном магазине. Однако не следует забывать, что такая форма ведения или домашней бухгалтерии, то бизнеса требует определенных знаний и умений, и определенного опыта и коммуникативных навыков.\n\nВладелец одного из предприятий, житель Житомирщины, воспользовавшись возможностями Интернета, решил купить авто у фирмы, зарегистрированной на территории другой области.\n\nМужчина позвонил продавцу, пообщался с ним и на платежную карту через терминал заплатил почти 5 тысяч гривен якобы за транспортные услуги и предоплату.\n\nИзлишне, наверное, говорить, что после уплаты суммы виртуальный партнер перестал выходить на связь, и никоим образом не контактировал с предпринимателем, кстати, знакомым лишь заочно.\n\n - Такие действия классифицируются Уголовным кодексом Украины как мошенничество с использованием компьютеров. И в отличие от других схем мошенничества, всевозможных порч, гаданий и т.д., достаточно строго наказываются лишением свободы на срок от 3 до 8 лет, - продолжает Ходаковский.\n\nПравоохранители уверяют, что Интернет не сможет скрыть личности виртуального мошенника. Технические возможности и налаженные механизмы взаимодействия с провайдерами позволяют отслеживать и устанавливать данные нечестных пользователей паутины, а следовательно и привлекать их к ответственности за обман людей.\n\nВпрочем, вот несколько практических советов, соблюдение которых поможет вам уберечься от неприятных неожиданностей:\nНе оставляйте на сайтах, в том числе социальных сетях, а также при проведении покупок конфиденциальной информации о себе и своих банковских карточках.\nДля онлайн-покупки через Интернет лучше использовать отдельно заведенные карточки.\nПри открытии счетов в банковских учреждениях лучше использовать контрактные номера мобильной связи. Это значительно уменьшит шансы доступа мошенников к вашему счету.\nНикому ни при каких обстоятельствах не сообщайте ПИН-код, пароли, коды доступа к своим счетам и любую информацию, которая приходит на ваш мобильный телефон в виде SMS-сообщений из банка. Работники банков не проводят такие операции по телефону.\nТолько ваша внимательность и бдительность убережет вас от мошенников.', 'Молодые супруги из Житомира пострадали от мошенничества в Интернете.\n\nКак стало известно «Журналу Житомира», сразу после свадьбы супруги решили продать свадебное платье. Разместили соответствующее объявление в интернет, где указали номер мобильного телефо', '2013-03-22 17:35:00', null, '', '', '', '', '', '', '', '', '', '', '2', null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8713', '3', '1', '2a13f825-9659-6d42-ff04-829315b41c9f', '19', 'zagalni-novini', '22', '', '', '', '1', '', null, 'Загальні новини', '', null, null, null, '', '', '', '', null, null, null, null, null, null, '2', '2', '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8714', '3', '1', 'e5ea28d3-8ddd-b759-1042-dfc67a21a9d4', '18', 'pod-zhitomirom-avtomobili-vytaskivayut-tankami-foto', '22', '', '', '', '1', null, null, 'Под Житомиром автомобили вытаскивают танками. ФОТО', '<span style=\"color: rgb(0, 0, 0);\">\nВ Житомирской области сложилась более сложная, чем в остальных областях ситуация в связи со снегопадами и снежными заносами.\n\nВ области в усиленном режиме работают кроме спасателей ГСЧС, специалисты Минобороны и облавтодора.\n \nВ настоящее время наихудшая ситуация сложилась в Бердичевском, Брусиловском, Ружинском, Коростышевском и Попельнянском районах, по территории которых проходят дороги государственного значения, где соответственно есть большая нагрузка автотранспорта.\n\nСложные участки автодорог, как показывает практика, вблизи села Хажин, Бердичевского района и села Белиловка, Ружинского района.\n \nВ настоящее время, для оказания помощи и проведения неотложных работ привлечены силы и средства Управления ГСЧС (100 человек личного состава и 36 единиц техники), Министерства обороны (12 человек личного состава и 6 единиц техники) и облавтодора (147 человек и 100 единиц техники).\n \nНепосредственно подразделениями Управления ГСЧС 22-23 марта было изъято 119 единиц транспорта из снежных заносов. Из которых 14 карет скорой помощи и один школьный автобус с детьми и один рейсовый. Также, было доставлено 2 больных и одну роженицу в районные больницы.\n \nСпасателями обеспечена доставка в населенные пункты 18 человек, которые находились в заметенных автомобилях. 23 марта пожарным автомобилем доставлялась бригада РЭС для устранения порывов на линиях электропередач в поселке Корнин.\n \nВсего по Житомирской области функционирует 67 стационарных пунктов обогрева. Но учитывая крайне сложную ситуацию, связанную с большим затором на автодороге Киев - Чоп, и с целью предупреждения случаев переохлаждения, силами Управления ГСЧС в селах Гадзинка, Житомирского района и Ставище, Брусиловского района, развернуто 2 стационарные палатки для обогрева, питания и предоставления первой медицинской помощи водителям и пассажирам автомобилей, а также обеспечено круглосуточное посменное дежурство личного состава.</span>', '\n\nВ Житомирской области сложилась более сложная, чем в остальных областях ситуация в связи со снегопадами и снежными заносами.\n\nВ области в усиленном режиме работают кроме спасателей ГСЧС, специалисты Минобороны и облавтодора.', '2013-03-25 12:04:00', null, '', '', '', '', '', '', '', '', '', '', '2', null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8715', '3', '1', 'a1efa150-06de-828e-fe85-80646bf642c5', '18', 'zhitomir-prodolzhaet-borotsya-so-snegopadami-ostanovlen-odin-trolleybusnyy-marshrut', '22', '', '', '', '1', null, null, 'Житомир продолжает бороться со снегопадами. Остановлен один троллейбусный маршрут', '<span style=\"color: rgb(0, 0, 0);\">23 марта, за прошедшие 12 часов, в Житомире выпало более месячной нормы осадков. В городе наблюдаются сугробы высотой до 1,5-1,8 метра.\n\nПо словам комунальщиков, в городе всю ночь работала снегоуборочная техника. Техника Водоканала очищала от снега районы Корбутовка и Малеванка, а техника Теплокоммунэнерго - Центр и Полевую.\n\nИз-за сложных погодных условий в Житомире создан оперативный штаб.\n\nИз общественного транспорта, остановлен один троллейбусный маршрут в направлении Черняховского моста. Все трамваи ездят с 10.00. Продолжается активная очистка трамвайных путей.\n\nИз-за сложных погодных условий по улице Московской произошел порыв водоводов (порыв трубы диаметром 300 мм). На месте аварии всю ночь работали рабочие и техника КП «Житомирводоканал». До 5:30 час. утра авария была ликвидирована.\n\n\nВИДЕО: Снегоочистительная техника стоит в сугробах\n\n\nПо информации из оперативного штаба, с 5 до 10 часов утра на придомовых территориях работало 468 дворников. Техника работает в круглосуточном режиме, меняются только водители. Дворники будут сегодня выходить на снегоуборочные работы с 14.00. (II смена) и с 19.30 ОГД. (III смена).\n\nВ свою очередь, мэр Житомира, который координирует работу оперативного штаба, выступил с инициативой премировать людей, работающих в сложных погодных условиях всю ночь.\n\nПо прогнозам Житомирского областного центра гидрометеорологии, 23-25 ??марта ожидаются сильные метели, снежные заносы, порывы ветра 17-25 м/с.\n\nЖитомирян просят без необходимости не выходить на улицу, а водителям не оставлять свои авто на обочине дорог, ведь это будет мешать работе снегоуборочной техники.\n\nВ случае возникновения сложной или чрезвычайной ситуации звоните по телефону круглосуточной линии 15-80.</span>', '23 марта, за прошедшие 12 часов, в Житомире выпало более месячной нормы осадков. В городе наблюдаются сугробы высотой до 1,5-1,8 метра.', '2013-03-25 12:05:00', null, '', '', '', '', '', '', '', '', '', '', '2', null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8716', '3', '1', '4d4bcb2f-7bfc-30e9-1b72-2b4a2777ed81', '19', 'novoni', '22', '', '', '', '1', '', null, 'Новони', '', null, null, null, '', '', '', '', null, null, null, null, null, null, '0', '1', '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8717', '3', '1', 'bd80a22e-5dba-ebf9-0b80-02a877633c6d', '18', 'sneg-v-zhitomire-ubirayut-no-ne-vyvozyat', '22', '', '', '', '1', null, null, 'Снег в Житомире убирают, но не вывозят', '<span style=\"color: rgb(0, 0, 0);\">Сегодня в Житомире коммунальные службы продолжают расчищать город от снега.\n\nК сожалению, дороги и пешеходные тротуары пока только чистят, но снег не вывозят. Из-за чего на обочинах выросли двухметровые сугробы.\n\n<a href=\"http://zhzhitomir.at.ua/_ph/1/2/97798881.jpg\" target=\"_blank\">link</a>Как сообщили «Журналу Житомира» в штабе, который координирует работу по уборке города от снега, коммунальная техника работает круглосуточно.\n\n - На работу вышли 51 единица техники, 24 из которых прочищают придомовые территории. - говорит начальник управления коммунального хозяйства Александр Марцун, - Особенностью нынешнего мартовского снегопада является высокая влажность. Снег на дорогах сразу превращается в лед, что затрудняет уборку.\n\nСегодня коммунальные службы города сосредоточили внимание на второстепенных улицах и придомовых территориях. На улицах города: 5 подметальных машин, 6 подметальных тракторов, 2 автогрейдера, 5 пескоразбрасывателей, 2 бульдозера, 2 экскаватора, 5 тракторов с передним плугом.\n\nПо состоянию на 24.03.2013 года использовано 620 тонн песчано-солевой смеси.\n\n\nВИДЕО: Пассажиры толкают троллейбусы\n\n\nНа сегодня движение транспорта, в том числе общественного, на главных, магистральных улицах Житомире обеспечено. Сейчас основной задачей остается расчистка второстепенных улиц, обеспечивающих в микрорайонах свободное передвижение транспорта.\n\n - На данный основное внимание сосредоточено на придомовых территориях, чтобы люди смогли вовремя и беспрепятственно добраться на работу. Подходы к учреждениям, офисам, все тротуары должны быть расчищены. Коммунальные предприятия в полном объеме обеспечены необходимыми горюче-смазочными материалами и объемами песчано-солевой смеси, - заметил Николай Боровец.\n\nНа придомовых территориях и других объектах благоустройства задействовано 20 подметальных тракторов и 4 трактора с передним плугом. На уборку тротуаров и придомовых территорий вышли 348 дворников.<img src=\"http://zhzhitomir.at.ua/_ph/1/2/239649268.jpg\" />\n\nКак сообщалось, вчера рота курсантов житомирского военного института восстанавливала движение трамваев в Житомире.\n</span>', 'Сегодня в Житомире коммунальные службы продолжают расчищать город от снега.\n\nК сожалению, дороги и пешеходные тротуары пока только чистят, но снег не вывозят. Из-за чего на обочинах выросли двухметровые сугробы.', '2013-03-25 12:16:00', null, '', '', '', '', '', '', '', 'Картинки 1', 'Евгеній', '', '0', null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8718', '3', '1', 'a1dba35c-88b8-9793-6615-bb3dd0e92f74', '18', 'zhizn-bez-boli--eto-vash-vybor', '22', '', '', '', '1', null, null, 'Жизнь без боли – это Ваш выбор!', 'Неврологические заболевания значительно снижают качество жизни, поскольку сопровождаются болью, нарушением подвижности и памяти. Чаще всего эти заболевания прогрессируют очень быстро, и поэтому принципиальным является своевременное обращение к врачу-неврологу. Опытный невролог уже на ранней стадии заболевания обнаружит имеющиеся нарушения нервной системы, подберет эффективное лечение, остановит развитие болезни и вылечит пациента.\n\nНа самые распространенные вопросы наших читателей отвечает Щербина Татьяна Николаевна – врач-невролог медицинского центра «Медибор», которая имеет 28-летний опыт работы в неврологии.\n\nТатьяна Николаевна, с какими проблемами чаще всего к Вам обращаются пациенты?\n\nСамой распространенной причиной обращения к врачу не только в неврологической, но и во всей медицинской практике, является головная боль. Периодически ее испытывает более 75% населения Украины, при этом большинство людей принимает анальгетики, даже не попытавшись разобраться в причинах этой боли. Головная боль может быть симптомом примерно 50 различных заболеваний. Поэтому если такая боль беспокоит вас больше чем 4 раза в месяц, вам необходима консультация невролога с целью установления причины боли и быстрой ликвидации заболевания.', 'Современный ритм жизни предъявляет повышенные требования к нашему организму и, в первую очередь, к нервной системе. ', '2013-03-27 11:04:00', null, '', '', '', '', '', '', '', '', '', '', '2', null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8719', '3', '1', 'a318f282-86b6-bcb7-4835-928c73281fbd', '85', 'ofisnyy-sotrudnik-v-otdel-kontaktov', '22', '', '', '', '1', null, null, 'Офисный сотрудник в отдел контактов', 'Требования:\n\n    свободное владение русским и украинским языком;\n    умение чётко и грамотно говорить;\n    отсутствие дефектов речи;\n    ответственность;\n    пунктуальность.\n\nКомпания предлагает:\n\n    работа в комфортном офисе;\n    обучение, тренинги за счёт компании;\n    профессиональный карьерный рост;\n    своевременную З/П;\n    гибкий график работы (полная/неполная занятость).\n\nКонтактное лицо: Елена 050 355 82 25.\n\n \n\nКонтактное лицо: Елена\n\nТелефон: 0503558225', 'Требуется офисный сотрудник в отдел контактов.\n\nДолжностные обязанности:\n\nназначение встреч по телефону.', '2013-03-28 10:07:00', null, '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8720', '3', '1', '396bc66d-30a2-3413-5ccf-66cae71a137b', '85', 'front-end-developer', '22', '', '', '', '1', null, null, 'Front-End Developer', 'Успішні кандидати повинні відповідати таким необхідних компетенцій / навичок:\n\n     Великий досвід в HTML, CSS, JavaScript, jQuery.\n     Здатність виробляти Valid HTML / CSS код відповідно до даної документацією.\n     Хороші навички спілкування в усній та письмовій англійської.\n     Знання ASP.NET MVC є сильною перевагою.\n     MS / ступінь бакалавра в галузі комп\'ютерних наук, ІТ або його еквівалент.\n\n \n\nЩоб дізнатися більше про Інфопульс Україна й інші переваги, будь ласка, см.: http://www.infopulse.com.ua/rus/vacancies/welcome', 'Infopulse Ukraine welcomes talented professionals to join our new project as Front-End Developer(Code: FED 110) in Kiev/ Vinnytsia/ Zhytomyr.', '2013-03-28 10:13:00', null, '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8721', '3', '1', '76a336f3-da73-0805-06e1-673cbec35023', '86', 'vakansiyi', '22', '', '', '', '1', 'Вакансія - вільний', null, 'Вакансії', '', null, null, null, '', '', '', '', null, null, null, null, null, null, null, '4', '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8722', '3', '1', 'ef54eb73-499a-ef02-554f-46238b8a6247', '85', 'operacionnyy-direktor', '22', '', '', '', '1', null, null, 'Операционный директор', 'Обязанности:\n\n    Создание технологий взаимодействия с бизнесом заказчиков, проектирование скриптов для работы операторов, контроль за эффективностью и юзабилити существующих программ;\n    Интегрирование работы call-центра с существующими технологиями и бизнес-процессами, как внутри организации, так и на стороне заказчика;\n    Анализ проекта и корректирование работы подразделений call-центра для решения задач заказчиков;\n    Инициирование разработки новых инструментов мониторинга.\n    Написание ТЗ.\n\nТребования:\n\n    Высшее техническое образование;\n    Опыт написания технических требований, технических заданий, функционально-логических схем;\n    Владение способами формализации и презентации алгоритмов;\n    Знание Excel, Visio и PowerPoint, опыт подготовки презентаций;\n    Коммуникабельность, активность, энергичность;\n    Грамотная устная и письменная речь;\n    Знание Английского языка на уровне.\n\nУсловия:\n\n    Официальное трудоустройство, социальный пакет;\n    Конкурентоспособная заработная плата;\n    Перспективы карьерного роста.\n', 'Требования к соискателю\n\n    опыт работы от 2 лет\n    высшее образование\n', '2013-03-28 14:11:00', null, '', '', '', '', '', '', '', '', '', '', null, null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8723', '3', '1', '212105bf-6e8e-8925-5db1-a74026832da1', '87', 'za-yakist-produkciyi', '22', null, null, '', '1', null, null, 'За якість продукції', 'Положенням «Про державні нагороди Української РСР», що діяло на момент проголошення незалежності України, було встановлено, що державними нагородами Української РСР є почесні звання Української РСР («Народний артист Української РСР», «Народний художник Української РСР», «Народний архітектор Української РСР» та 26 почесних звань категорї «Заслужений»), Почесна Грамота і Грамота Президії Верховної Ради Української РСР.[2]. Також за станом на 1991 рік в УРСР присуджувалися Державні премії Української РСР в галузі науки і техніки та за видатні досягнення у праці і науково-технічній творчості; Державна премія Української РСР імені Т. Г. Шевченка в галузі літератури, журналістики і мистецтва; Державна премія Української РСР по архітектурі.\n\nЗаконом України «Про внесення змін і доповнень до Конституції (Основного Закону) України» від 14 лютого 1992 р. в Конституцію (Основний Закон) України 1978 р. була внесена норма, згідно з якою Президент України засновує президентські відзнаки і нагороджує ними (ст. 114-5). Згідно з Конституцією України 1996 р., Президент України нагороджує державними нагородами, встановлює президентські відзнаки та нагороджує ними (ст. 106); разом із тим, установлено, що державні нагороди встановлюються виключно законами України (ст. 92).\n\nПрезиденти України Л. М. Кравчук та Л. Д. Кучма своїми Указами встановлювали відзнаки Президента України та нагороджували ними.\n\nПерші запроваджені відзнаки — Почесна відзнака Президента України (1992) та відзнаки Президента України «За мужність» — зірка «За мужність» і хрест «За мужність» (1995) — у 1996 році були замінені новими відзнаками Президента України — орденами «За заслуги» та «За мужність»; при цьому нагороджені визнавалися кавалерами відповідних орденів зі збереженням права на носіння вручених їм відзнак.\n\nБули також запроваджені відзнаки Президента України — «Іменна вогнепальна зброя», «Орден Богдана Хмельницького», «Орден князя Ярослава Мудрого» (1995), медаль «За військову службу Україні», медаль «За бездоганну службу» (1996), «Орден княгині Ольги» (1997), «Герой України» (з врученням ордена «Золота Зірка» або ордена Держави) (1998), Почесна Грамота Президента України за активну благодійницьку діяльність у гуманітарній сфері, почесне звання «Заслужений лісівник України», медаль «Захиснику Вітчизни», почесне звання «Заслужений працівник соціальної сфери України» (1999).\n\nТакож Указом Президента України Л. М. Кравчука 1993 року було засновано пам\'ятний знак «50 років визволення України», нагородження яким було проведено Указом Президента України Л. Д. Кучми у 1994 р.', 'Державні нагороди України — вища форма відзначення громадян України за видатні заслуги у розвитку економіки, науки, культури, соціальної сфери, захисті', null, null, '{SITE_URL}/frontend/webcontent/images/250%20(1).jpg', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8724', '3', '1', '79443be0-f88c-ba10-7f0c-2b86752dfc15', '87', 'za-vidvagu', '22', null, null, '', '1', null, null, 'За відвагу', '	У 2013 році компанія «Ернст енд Янг» в Україні стала переможцем конкурсу «Благодійна Україна» серед великих компаній. Багаторічна програма «Дружба», представлена на конкурс, описує комплекс ініцатив на підтримку дітей-сиріт, що передбачає волонтерські поїздки до дітей, спільні заходи, тренінги та майстерні від співробітників, залучення дітей до розвиваючих програм та підтримку студентів-сиріт.\n«Ернст енд Янг» в Україні стала переможницею конкурсу «Корпоративне волонтерство 2012» в номінації «Освіта» за програму для студентів «Крок у майбутнє». Конкурс було організовано Фондом Східна Європа, Глобальним Договором ООН в Україні, Американською торгівельною палатою, Європейською Бізнес Асоціацією та Українським Форумом Благодійників.\nКомпанія «Ернст енд Янг» отримала золоту премію «HR-БРЕНД Україна 2012» в номинації «Столиця» - за програму Wellness, спрямовану на вирівнювання балансу між роботою та особистим життям співробітників (комплекс заходів, спрямованих на підтримку здорового і активного способу життя та розкриття інтелектуального потенціалу). «HR-БРЕНД» - це незалежна щорічна премія за найбільш успішну роботу з репутацією компанії як роботодавця, заснована групою компаній HeadHunter (hh.ru).', 'Нагороди для «Ернст енд Янг» в Україні:', null, null, '{SITE_URL}/frontend/webcontent/images/250%20(20).jpg', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8725', '3', '1', '9eb3885c-94bc-0682-5755-09395a24c393', '87', 'za-muzhnist', '22', null, null, '', '1', null, null, 'За мужність', 'зайняв почесне шістнадцяте місце рейтингу «ТОП-100. Кращі топ-менеджери України» серед керівників юридичних компаній. Основними критеріями при формуванні рейтингу стали: репутація топ-менеджера і його авторитет серед колег, наявність чіткої стратегії розвитку та позитивна динаміка розвитку бізнесу.\n\nЕкспертами при складанні рейтингу виступили керівники компаній різних галузей, які оцінили один одного в своїх сегментах ринку. За допомогою оцінок топ-менеджерами своїх колег-конкурентів складаються галузеві рейтинги і загальний рейтинг (ТОП-100) менеджерів.\n\nРейтинг «ТОП-100. Кращі топ-менеджери України», складений тижневиком «ІнвестГазета», опублікований в журналі «ТОП-100. Рейтинг кращих компаній України». ', 'Керуючий партнер Юридичної Фірми «АС Консалтинг» ', null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8726', '3', '1', '169a1a83-fedc-3b1c-81dc-71fa37d0e7e8', '87', 'sertifikat-yakosti-produkciyi', '22', null, null, '', '1', null, null, 'Сертифікат якості продукції', 'Всеукраїнського конкурсу якості продукції «100 кращих товарів України»', 'Переможець регіонального етапу ', null, null, '{SITE_URL}/frontend/webcontent/images/250%20(20).jpg', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8727', '3', '1', '2d87b5df-cf43-7718-1301-1f322dcd2e4f', '87', 'peremozhec-litnogo-chempionatu-soccer-land-z-mini-futbolu-u-vischiy-lizi-2009-roku', '22', null, null, '', '1', null, null, ' Переможець літнього чемпіонату «Soccer-Land» з міні-футболу у вищій лізі 2009 року;', 'Також, компанія «ДЕН» займається розвитком своїх працівників не тільки у професійній сфері, але і в підтримці корпоративної культури, участю в різних соціальних і благодійних проектах. Наша соціальна активність була високо оцінена, за що ми й отримали нагороду від центру «Розвитку КСВ» за кращий бізнес-кейс у сфері корпоративної соціальної відповідальності.', 'компанія «ДЕН» займається розвитком своїх працівників', null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8728', '3', '1', '6ea1df81-352e-5124-c988-d93be8a3f7ad', '39', 'search', '22', null, '', '', '1', 'Пошук', null, 'search', '', null, null, null, 'error during search', 'ок', '', '', null, null, null, null, null, null, '1', '3', '0', '0', null, null, null, '2013-08-27 17:46:03');
INSERT INTO `fe_Pages` VALUES ('8729', '3', '1', '4954cc1b-27a4-99b6-b6f7-08832c44d63c', '40', null, '0', null, null, '', '1', null, null, 'Форма пошуку', '', null, null, null, '', '{SITE_URL_PAGES}search.php?pagecode=search&lang=en', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2014-01-17 16:10:43');
INSERT INTO `fe_Pages` VALUES ('8730', '3', '1', '154a491c-fb90-a114-73ba-af5d7b88b26e', '15', null, '0', null, null, '', '1', null, null, 'Головний логотип', '', null, null, null, '{SITE_URL}/frontend/webcontent/images/logo.jpg', 'Dream Blouses', '/', '', null, null, null, null, null, null, '0', null, '0', '0', null, null, null, '2013-09-26 16:56:34');
INSERT INTO `fe_Pages` VALUES ('8731', '3', '1', '7dfdc469-9966-59ba-16e4-455a8f935dda', '14', null, '0', null, null, '', '1', null, null, 'Слоган сайту', '<img class = \"slogan\" src=\"{SITE_URL}/frontend/webcontent/images/slogan.png\" alt=\"\" />', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8732', '3', '1', 'd32c96a8-78f4-ce6c-a2d7-bb3f57b5c861', '62', null, '0', null, null, '', '1', null, null, 'Вибір мови', '', null, null, null, '', '', '', '', null, null, null, null, null, null, '1', null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8733', '3', '1', '634af085-e0df-9050-253b-d9ff1a735aeb', '14', null, '0', null, null, '', '1', null, null, 'Логотип_слоган', '<div class=\"logo_slogan\">\n<div class=\"smoll_logo\"><img src=\"{SITE_URL}/frontend/webcontent/images/smoll_logo.png\" alt=\"\" /></div>\n<div class=\"slogan_smoll\"><img alt=\"\" src=\"{SITE_URL}/frontend/webcontent/images/slogan_smoll.png\" /></div>\n</div>', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8734', '3', '1', '576923ec-68e7-8b23-d62b-b8d54f652246', '14', null, '0', null, null, '', '1', null, null, ' Торгова марка “Руден”', '<div>&copy; Торгова марка &ldquo;Руден&rdquo; 2007-2013</div>', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8735', '3', '1', '77c31a24-d05e-4379-35f7-7b6682e2f44b', '14', null, '0', null, null, '', '1', null, null, 'Футер-меню', '<ul class=\"footer_menu\">\n<li>\n<a href=\"{SITE_URL}/ua/home/home.htm\">Головна</a>\n</li>\n<li>\n<a href=\"{SITE_URL}/ua/home/home.htm\">Продукція</a>\n</li>\n<li>\n<a href=\"{SITE_URL}/ua/home/home.htm\">Дистриб\'юція</a>\n</li>\n<li>\n<a href=\"{SITE_URL}/ua/home/home.htm\">Новини</a>\n</li>\n<li>\n<a href=\"{SITE_URL}/ua/home/home.htm\">Рецепти</a>\n</li>\n<li>\n<a href=\"{SITE_URL}/ua/home/home.htm\">Торгівля</a>\n</li>\n<li>\n<a href=\"{SITE_URL}/ua/home/home.htm\">Партнери</a>\n</li>\n<li>\n<a href=\"{SITE_URL}/ua/vacancy_list/vakansiyi.htm\">Вакансії</a>\n</li>\n<li>\n<a href=\"{SITE_URL}/ua/home/home.htm\">Контакти</a>\n</li>\n</ul>', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8736', '3', '1', 'a7715e75-f8cf-48d0-61fa-2132de8a0dc6', '14', null, '0', null, null, '', '1', null, null, 'Футер-соц.сети', '<div class=\"join-and-follow minimized\">\n                <a class=\"join-and-follow-header\" href=\"#\">JOIN OUR <span class=\"newsletter-text\">NEWSLETTER</span>\n                </a>\n                <p class=\"join-block-text\">\n                    Keep up to date with the lastest Dream Blouses news!\n                </p>\n                <div class=\"join-block\">\n                    <input type=\"text\" placeholder=\"Your email\" class=\"mail-input\" />\n                    <a class=\"join-button brown\">JOIN</a>\n                </div>\n                <div class=\"horizontal-line brown\">\n                </div>\n                <div class=\"followUs-block\">\n                    FOLLOW US\n                    <div class=\"social-button facebook\">\n                    </div>\n                    <div class=\"social-button twitter\">\n                    </div>\n                    <div class=\"social-button google\">\n                    </div>\n                </div>\n                <div class=\"copyright\">\n                    © AREFEVA, 2013\n                </div>\n            </div>\n<script type=\"text/javascript\">		    \n            $(\'.join-and-follow-header\').click(function () { var toogleBlock = $(\'.join-and-follow\'); if (toogleBlock.hasClass(\'minimized\')) toogleBlock.removeClass(\'minimized\'); else toogleBlock.addClass(\'minimized\'); });\n        </script>', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-06-19 12:40:33');
INSERT INTO `fe_Pages` VALUES ('8764', '3', '1', '242b78c7-6c21-e0b1-c740-5262afecac4e', '88', null, '0', null, null, '', '1', null, null, 'JOIN OUR NEWSLETTER', '', 'Keep up to date with the lastest Dream Blouses news!', null, null, 'Keep up to date with the lastest Dream Blouses news!', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-06-20 10:26:13');
INSERT INTO `fe_Pages` VALUES ('8768', '3', '1', 'fc189fcf-d554-05cb-3ccf-8f4fec983bc5', '14', null, '0', null, null, '', '1', null, null, 'Top Links HTML (en)', '<ul class=\"top-links\"> \n                    <li><a href=\"{SITE_URL}/en/content/faq--help.htm\" class=\"faq-link\">Faq &amp; Help</a></li>\n                    <li><a href=\"{SITE_URL}/en/content/payment.htm\" class=\"payment-link\">Payment</a></li>\n                    <li><a href=\"{SITE_URL}/en/content/shipment.htm\" class=\"shipment-link\">Shipment</a></li>\n                    <li><a href=\"{SITE_URL}/en/content/returnsexchanges.htm\" class=\"exchange-link\">Returns/Exchanges</a></li>\n                </ul>', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-08-21 12:08:44');
INSERT INTO `fe_Pages` VALUES ('8769', '3', '1', 'b7e43913-5e3b-b79a-e80c-f9ae264ede16', '14', null, '0', null, null, '', '1', null, null, 'Shopping Cart HTML (en)', '<a class=\"shipping-cart-link\">Shopping cart<span class=\"products-amount-label\">10</span></a>', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-08-08 16:35:50');
INSERT INTO `fe_Pages` VALUES ('8770', '3', '1', 'd3b24b76-9e7a-641f-57d1-ecc22135dcfb', '6', null, '0', null, null, '', '1', null, null, 'Bread crumbs', '', null, null, null, 'templates/PageObjects/BreadCrumbsMenu.tpl', '', '', '', null, null, null, null, null, null, '8705', null, '0', '0', null, null, null, '2013-08-30 12:09:05');
INSERT INTO `fe_Pages` VALUES ('8771', '3', '1', 'c64ac6f9-bd1d-ea0d-4b50-a2c15858ab92', '15', null, '0', null, null, '', '1', null, null, 'Лого на сторінці категорії', '', null, null, null, '{SITE_URL}/frontend/webcontent/images/logo_2.png', 'Dream Blouses', '/', '', null, null, null, null, null, null, '0', null, '0', '0', null, null, null, '2013-10-11 11:03:33');
INSERT INTO `fe_Pages` VALUES ('8772', '3', '1', '1a13d921-6324-0913-6573-3fae09a9dc33', '37', 'log-in', '22', null, '', '', '1', 'Have you been at The Dream Blouses before? Fill in your email address and password and we will retrieve your registered data.', 'Is this your first time here? We will ask you for some data in order to make your shopping as easy and safe as possible.', 'LOG IN', '', 'Check your email for registration confirmation', null, null, 'I`am already a customer', 'Not a customer yet?', 'Succeess registration confirmation', 'Error registration confirmation', null, null, null, null, null, null, null, '0', '0', '0', null, null, null, '2013-09-02 12:30:56');
INSERT INTO `fe_Pages` VALUES ('8773', '3', '1', '446b01ab-9f70-15d6-c965-c20989cbdaf7', '12', 'faq--help', '22', '', '', '', '1', null, null, 'FAQ & HELP', '<h1>Lorem ipsum dolor sit amet</h1>\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla in ligula at erat dictum molestie eget vel lacus. Nulla facilisi. Pellentesque euismod purus egestas felis adipiscing interdum. Sed fringilla at erat eu condimentum. Sed scelerisque luctus augue. Nunc vehicula nunc odio, eu lobortis est hendrerit in. Sed porta neque ut velit dapibus, et rutrum nisl eleifend. Vivamus sodales est pretium enim eleifend accumsan. Phasellus iaculis quam leo, non tempor lacus mattis sit amet. Praesent ipsum nisi, laoreet at purus a, malesuada tristique mi. Curabitur venenatis orci ornare, fringilla lorem non, euismod nisi. Nulla facilisi. Curabitur dolor justo, ullamcorper at varius quis, hendrerit vitae diam. In ante dui, convallis ut vehicula in, cursus non eros. Aenean vulputate ante vel dolor vulputate, non tincidunt erat sollicitudin.\n<br />\n<br />\n<img hspace=\"10\" align=\"left\" src=\"{SITE_URL}/frontend/webcontent/images/product-1.jpg\" alt=\"\" />\n<div class=\"contentPageDescription\"><p>In molestie sed odio at posuere. Etiam a sagittis nulla. Cras sit amet arcu non lorem aliquam posuere. Aenean placerat nisi vitae elementum volutpat. Sed consequat velit tincidunt neque posuere sollicitudin. Nulla facilisi. Praesent feugiat semper risus ut elementum. Mauris quis posuere nulla, at condimentum lacus. Cras diam mauris, auctor elementum nisl vel, facilisis aliquet nibh. Ut interdum risus eu massa euismod, ut suscipit tellus rutrum. Fusce fermentum nisl libero, vitae volutpat purus egestas ac. Quisque auctor tempus libero, vel venenatis mi accumsan non. Vivamus augue mi, tincidunt vitae arcu non, suscipit ultricies arcu. Nam sed eros lectus. Ut eu libero congue risus vestibulum porta et nec velit.\n<br />\n<br />\nNulla dignissim faucibus porttitor. Donec sit amet fringilla odio. Morbi at risus ut nunc rutrum venenatis. Etiam ornare, est a posuere euismod, metus dui placerat velit, non lobortis risus risus eget diam. Nulla pharetra tellus nec dolor aliquet varius. Donec lacus justo, convallis a ligula quis, molestie rhoncus libero. Quisque pulvinar porta turpis, sed molestie magna ornare id. In ultrices ante felis, et venenatis lectus pulvinar sit amet. Sed mi mi, mollis sit amet volutpat sit amet, consequat id ligula. Nam congue tincidunt lacinia. Aliquam erat volutpat. \n<br />\n<br />\nUt viverra justo libero, egestas blandit est volutpat sed. Quisque congue elit libero. Nam imperdiet quam nisi, ut congue ipsum pharetra ullamcorper. Duis imperdiet at nibh at consectetur. Nulla semper sagittis sodales. Fusce sodales ipsum ac consequat placerat. Etiam odio felis, consequat vel eleifend vitae, placerat sed urna. Curabitur adipiscing nulla vel velit mollis, in laoreet urna pulvinar. Cras venenatis turpis felis, in porta mi ultrices facilisis. Aliquam fermentum nisl et libero placerat laoreet. Vestibulum at molestie metus. Sed pulvinar ultrices sapien. Nullam aliquam sem erat, id scelerisque nulla fermentum et. Integer volutpat vulputate aliquam. Etiam congue condimentum elit, at eleifend felis posuere id. Praesent suscipit purus ut nisi interdum, a malesuada ligula consequat. \n<br />\n<br />\nPraesent non blandit sem. Nullam sed porttitor erat. Pellentesque mi urna, aliquet eu lobortis vitae, cursus quis risus. Phasellus vestibulum nisi eget arcu facilisis mollis. In a mi nec orci sodales porta. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec mollis gravida lectus a ultricies. \n<br />\n<br />\nNullam at ipsum suscipit, tempus lacus at, consequat lectus. Integer placerat, lectus vel condimentum eleifend, odio purus euismod ligula, non faucibus neque augue sed libero. Maecenas malesuada felis at justo aliquam, vel laoreet tortor placerat. Praesent blandit ligula non risus elementum, in pretium lectus congue. Vestibulum lobortis lectus vitae luctus suscipit. In laoreet dolor et ante consectetur dapibus. Vivamus eget ligula eleifend, euismod lectus id, dictum lacus. Mauris vel diam eget nibh fermentum tristique sed sit amet leo. Cras hendrerit augue sit amet blandit vulputate. Cras pulvinar elit massa, sed scelerisque mi rutrum sed. Praesent dapibus mi a ornare condimentum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.\n<br />\n<br />\nFusce tincidunt gravida eros vel ultricies. Sed a justo ac tellus lacinia interdum id at tortor. Phasellus sagittis ante ipsum, in semper metus consectetur vel. Quisque augue ante, eleifend eu sagittis vel, pulvinar porta nisl. Aliquam mattis, nisi a tincidunt fringilla, dolor odio euismod neque, blandit pellentesque felis libero et arcu. Vivamus congue enim a felis bibendum mollis. Vestibulum imperdiet posuere magna vel suscipit. Maecenas suscipit vitae nunc ac congue. Aenean mattis et lacus at dignissim. Mauris urna orci, mattis quis venenatis vel, egestas eget justo. Quisque vitae erat lorem. Proin molestie, odio sit amet vulputate ultrices, nulla lectus feugiat lorem, in volutpat lectus neque at urna. Donec molestie molestie euismod. Nullam commodo vulputate mauris sit amet eleifend. Vestibulum hendrerit pharetra magna. Integer facilisis, dui sed condimentum viverra, lacus tortor dapibus nunc, in pharetra tortor magna a ligula.\n</p>\n</div>', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-09-12 13:20:02');
INSERT INTO `fe_Pages` VALUES ('8774', '3', '1', '27215c96-9c9a-7ee8-35d4-134891293eef', '12', 'payment', '22', '', '', '', '1', null, null, 'Payment', '<h1>Lorem ipsum dolor sit amet</h1>\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla in ligula at erat dictum molestie eget vel lacus. Nulla facilisi. Pellentesque euismod purus egestas felis adipiscing interdum. Sed fringilla at erat eu condimentum. Sed scelerisque luctus augue. Nunc vehicula nunc odio, eu lobortis est hendrerit in. Sed porta neque ut velit dapibus, et rutrum nisl eleifend. Vivamus sodales est pretium enim eleifend accumsan. Phasellus iaculis quam leo, non tempor lacus mattis sit amet. Praesent ipsum nisi, laoreet at purus a, malesuada tristique mi. Curabitur venenatis orci ornare, fringilla lorem non, euismod nisi. Nulla facilisi. Curabitur dolor justo, ullamcorper at varius quis, hendrerit vitae diam. In ante dui, convallis ut vehicula in, cursus non eros. Aenean vulputate ante vel dolor vulputate, non tincidunt erat sollicitudin.<br />\n<br />\n<img hspace=\"10\" align=\"left\" src=\"{SITE_URL}/frontend/webcontent/images/product-1.jpg\" alt=\"\" /><div class=\"contentPageDescription\"><p>In molestie sed odio at posuere. Etiam a sagittis nulla. Cras sit amet arcu non lorem aliquam posuere. Aenean placerat nisi vitae elementum volutpat. Sed consequat velit tincidunt neque posuere sollicitudin. Nulla facilisi. Praesent feugiat semper risus ut elementum. Mauris quis posuere nulla, at condimentum lacus. Cras diam mauris, auctor elementum nisl vel, facilisis aliquet nibh. Ut interdum risus eu massa euismod, ut suscipit tellus rutrum. Fusce fermentum nisl libero, vitae volutpat purus egestas ac. Quisque auctor tempus libero, vel venenatis mi accumsan non. Vivamus augue mi, tincidunt vitae arcu non, suscipit ultricies arcu. Nam sed eros lectus. Ut eu libero congue risus vestibulum porta et nec velit.<br />\n<br />\nNulla dignissim faucibus porttitor. Donec sit amet fringilla odio. Morbi at risus ut nunc rutrum venenatis. Etiam ornare, est a posuere euismod, metus dui placerat velit, non lobortis risus risus eget diam. Nulla pharetra tellus nec dolor aliquet varius. Donec lacus justo, convallis a ligula quis, molestie rhoncus libero. Quisque pulvinar porta turpis, sed molestie magna ornare id. In ultrices ante felis, et venenatis lectus pulvinar sit amet. Sed mi mi, mollis sit amet volutpat sit amet, consequat id ligula. Nam congue tincidunt lacinia. Aliquam erat volutpat. <br />\n<br />\nUt viverra justo libero, egestas blandit est volutpat sed. Quisque congue elit libero. Nam imperdiet quam nisi, ut congue ipsum pharetra ullamcorper. Duis imperdiet at nibh at consectetur. Nulla semper sagittis sodales. Fusce sodales ipsum ac consequat placerat. Etiam odio felis, consequat vel eleifend vitae, placerat sed urna. Curabitur adipiscing nulla vel velit mollis, in laoreet urna pulvinar. Cras venenatis turpis felis, in porta mi ultrices facilisis. Aliquam fermentum nisl et libero placerat laoreet. Vestibulum at molestie metus. Sed pulvinar ultrices sapien. Nullam aliquam sem erat, id scelerisque nulla fermentum et. Integer volutpat vulputate aliquam. Etiam congue condimentum elit, at eleifend felis posuere id. Praesent suscipit purus ut nisi interdum, a malesuada ligula consequat. <br />\n<br />\nPraesent non blandit sem. Nullam sed porttitor erat. Pellentesque mi urna, aliquet eu lobortis vitae, cursus quis risus. Phasellus vestibulum nisi eget arcu facilisis mollis. In a mi nec orci sodales porta. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec mollis gravida lectus a ultricies. <br />\n<br />\nNullam at ipsum suscipit, tempus lacus at, consequat lectus. Integer placerat, lectus vel condimentum eleifend, odio purus euismod ligula, non faucibus neque augue sed libero. Maecenas malesuada felis at justo aliquam, vel laoreet tortor placerat. Praesent blandit ligula non risus elementum, in pretium lectus congue. Vestibulum lobortis lectus vitae luctus suscipit. In laoreet dolor et ante consectetur dapibus. Vivamus eget ligula eleifend, euismod lectus id, dictum lacus. Mauris vel diam eget nibh fermentum tristique sed sit amet leo. Cras hendrerit augue sit amet blandit vulputate. Cras pulvinar elit massa, sed scelerisque mi rutrum sed. Praesent dapibus mi a ornare condimentum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.<br />\n<br />\nFusce tincidunt gravida eros vel ultricies. Sed a justo ac tellus lacinia interdum id at tortor. Phasellus sagittis ante ipsum, in semper metus consectetur vel. Quisque augue ante, eleifend eu sagittis vel, pulvinar porta nisl. Aliquam mattis, nisi a tincidunt fringilla, dolor odio euismod neque, blandit pellentesque felis libero et arcu. Vivamus congue enim a felis bibendum mollis. Vestibulum imperdiet posuere magna vel suscipit. Maecenas suscipit vitae nunc ac congue. Aenean mattis et lacus at dignissim. Mauris urna orci, mattis quis venenatis vel, egestas eget justo. Quisque vitae erat lorem. Proin molestie, odio sit amet vulputate ultrices, nulla lectus feugiat lorem, in volutpat lectus neque at urna. Donec molestie molestie euismod. Nullam commodo vulputate mauris sit amet eleifend. Vestibulum hendrerit pharetra magna. Integer facilisis, dui sed condimentum viverra, lacus tortor dapibus nunc, in pharetra tortor magna a ligula.</p></div>', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-08-21 12:06:35');
INSERT INTO `fe_Pages` VALUES ('8775', '3', '1', 'cd467d88-23c5-a001-c290-c1ee4a184ef9', '12', 'shipment', '22', '', '', '', '1', null, null, 'Shipment', '<h1>Lorem ipsum dolor sit amet</h1>\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla in ligula at erat dictum molestie eget vel lacus. Nulla facilisi. Pellentesque euismod purus egestas felis adipiscing interdum. Sed fringilla at erat eu condimentum. Sed scelerisque luctus augue. Nunc vehicula nunc odio, eu lobortis est hendrerit in. Sed porta neque ut velit dapibus, et rutrum nisl eleifend. Vivamus sodales est pretium enim eleifend accumsan. Phasellus iaculis quam leo, non tempor lacus mattis sit amet. Praesent ipsum nisi, laoreet at purus a, malesuada tristique mi. Curabitur venenatis orci ornare, fringilla lorem non, euismod nisi. Nulla facilisi. Curabitur dolor justo, ullamcorper at varius quis, hendrerit vitae diam. In ante dui, convallis ut vehicula in, cursus non eros. Aenean vulputate ante vel dolor vulputate, non tincidunt erat sollicitudin.<br />\n<br />\n<img width=\"231\" hspace=\"10\" height=\"348\" align=\"left\" src=\"{SITE_URL}/frontend/webcontent/images/product-3.jpg\" alt=\"\" /></p>\n<p>In molestie sed odio at posuere. Etiam a sagittis nulla. Cras sit amet arcu non lorem aliquam posuere. Aenean placerat nisi vitae elementum volutpat. Sed consequat velit tincidunt neque posuere sollicitudin. Nulla facilisi. Praesent feugiat semper risus ut elementum. Mauris quis posuere nulla, at condimentum lacus. Cras diam mauris, auctor elementum nisl vel, facilisis aliquet nibh. Ut interdum risus eu massa euismod, ut suscipit tellus rutrum. Fusce fermentum nisl libero, vitae volutpat purus egestas ac. Quisque auctor tempus libero, vel venenatis mi accumsan non. Vivamus augue mi, tincidunt vitae arcu non, suscipit ultricies arcu. Nam sed eros lectus. Ut eu libero congue risus vestibulum porta et nec velit.<br />\n<br />\nNulla dignissim faucibus porttitor. Donec sit amet fringilla odio. Morbi at risus ut nunc rutrum venenatis. Etiam ornare, est a posuere euismod, metus dui placerat velit, non lobortis risus risus eget diam. Nulla pharetra tellus nec dolor aliquet varius. Donec lacus justo, convallis a ligula quis, molestie rhoncus libero. Quisque pulvinar porta turpis, sed molestie magna ornare id. In ultrices ante felis, et venenatis lectus pulvinar sit amet. Sed mi mi, mollis sit amet volutpat sit amet, consequat id ligula. Nam congue tincidunt lacinia. Aliquam erat volutpat. <br />\n<br />\nUt viverra justo libero, egestas blandit est volutpat sed. Quisque congue elit libero. Nam imperdiet quam nisi, ut congue ipsum pharetra ullamcorper. Duis imperdiet at nibh at consectetur. Nulla semper sagittis sodales. Fusce sodales ipsum ac consequat placerat. Etiam odio felis, consequat vel eleifend vitae, placerat sed urna. Curabitur adipiscing nulla vel velit mollis, in laoreet urna pulvinar. Cras venenatis turpis felis, in porta mi ultrices facilisis. Aliquam fermentum nisl et libero placerat laoreet. Vestibulum at molestie metus. Sed pulvinar ultrices sapien. Nullam aliquam sem erat, id scelerisque nulla fermentum et. Integer volutpat vulputate aliquam. Etiam congue condimentum elit, at eleifend felis posuere id. Praesent suscipit purus ut nisi interdum, a malesuada ligula consequat. <br />\n<br />\nPraesent non blandit sem. Nullam sed porttitor erat. Pellentesque mi urna, aliquet eu lobortis vitae, cursus quis risus. Phasellus vestibulum nisi eget arcu facilisis mollis. In a mi nec orci sodales porta. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec mollis gravida lectus a ultricies. <br />\n<br />\nNullam at ipsum suscipit, tempus lacus at, consequat lectus. Integer placerat, lectus vel condimentum eleifend, odio purus euismod ligula, non faucibus neque augue sed libero. Maecenas malesuada felis at justo aliquam, vel laoreet tortor placerat. Praesent blandit ligula non risus elementum, in pretium lectus congue. Vestibulum lobortis lectus vitae luctus suscipit. In laoreet dolor et ante consectetur dapibus. Vivamus eget ligula eleifend, euismod lectus id, dictum lacus. Mauris vel diam eget nibh fermentum tristique sed sit amet leo. Cras hendrerit augue sit amet blandit vulputate. Cras pulvinar elit massa, sed scelerisque mi rutrum sed. Praesent dapibus mi a ornare condimentum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.<br />\n<br />\nFusce tincidunt gravida eros vel ultricies. Sed a justo ac tellus lacinia interdum id at tortor. Phasellus sagittis ante ipsum, in semper metus consectetur vel. Quisque augue ante, eleifend eu sagittis vel, pulvinar porta nisl. Aliquam mattis, nisi a tincidunt fringilla, dolor odio euismod neque, blandit pellentesque felis libero et arcu. Vivamus congue enim a felis bibendum mollis. Vestibulum imperdiet posuere magna vel suscipit. Maecenas suscipit vitae nunc ac congue. Aenean mattis et lacus at dignissim. Mauris urna orci, mattis quis venenatis vel, egestas eget justo. Quisque vitae erat lorem. Proin molestie, odio sit amet vulputate ultrices, nulla lectus feugiat lorem, in volutpat lectus neque at urna. Donec molestie molestie euismod. Nullam commodo vulputate mauris sit amet eleifend. Vestibulum hendrerit pharetra magna. Integer facilisis, dui sed condimentum viverra, lacus tortor dapibus nunc, in pharetra tortor magna a ligula.</p>', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-09-03 09:49:33');
INSERT INTO `fe_Pages` VALUES ('8776', '3', '1', '4a29eb10-54a4-f748-e202-316ebe1efaf5', '12', 'returnsexchanges', '22', '', '', '', '1', null, null, 'Returns/Exchanges', 'vyuhjvbiukbn', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-09-12 12:02:36');
INSERT INTO `fe_Pages` VALUES ('8777', '3', '1', '6801c895-e2f0-ba39-ae7a-2b4757a4faa7', '19', 'look-book', '22', 'qqq', 'qqq', 'qqq', '1', '', null, 'Look Book', '', null, null, null, '', '', '', '', null, null, null, null, null, null, '0', '5', '0', '0', null, null, null, '2013-08-30 16:07:00');
INSERT INTO `fe_Pages` VALUES ('8789', '3', '1', 'ab409760-ca36-2466-660f-fae612ddc982', '133', null, '0', null, null, '', '1', null, null, 'Shopping cart', '', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-09-02 16:12:20');
INSERT INTO `fe_Pages` VALUES ('8790', '3', '1', '0bf1597e-a244-1181-296b-9c4ddd665917', '83', 'private-office', '22', '', '', '', '1', null, null, 'Private office', '', null, null, null, '', '#', '#', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-09-02 16:15:13');
INSERT INTO `fe_Pages` VALUES ('8791', '3', '1', '47c6504c-c9fc-97a2-cf13-067565a826cb', '134', 'your-shoppingbag', '22', '', '', '', '1', null, null, 'Your shoppingbag', '', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-09-05 10:35:21');
INSERT INTO `fe_Pages` VALUES ('8795', '3', '1', 'cc6f4c19-eda4-581e-e5ff-f314dec5550a', '135', 'sign-in-register', '22', '', '', '', '1', null, null, 'Sign in / Register', '', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-09-10 17:35:47');
INSERT INTO `fe_Pages` VALUES ('8799', '3', '1', 'f3225024-4c3a-1f27-2dd4-437ce97933f4', '136', 'billing-and-shipping', '22', '', '', '', '1', null, null, 'Billing and shipping', '', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-09-10 16:47:36');
INSERT INTO `fe_Pages` VALUES ('8803', '3', '1', 'ef9cf99e-3b26-c5b9-2d7c-f1145a430e3c', '137', 'order-overview', '22', '', '', '', '1', null, null, 'Order overview', '', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-09-10 16:50:41');
INSERT INTO `fe_Pages` VALUES ('8811', '3', '1', '48cc0ded-68c3-e067-dc8d-587d512b0b35', '138', 'confirmation', '22', '', '', '', '1', '<h2><center>Thank you for your order!</center></h2>\n<p style=\"text-align: center;\">Aliquam sed odio fermentum, dictum libero quis, venenatis odio.  \nPhasellus sit amet ligula libero. Nam tempus diam neque, at tincidunt  metus eleifend sed. \nDonec luctus leo cursus imperdiet eleifend. Nam nec  tristique magna. Nunc dapibus sed turpis non accumsan. \nAenean eget nibh  leo. Aenean lacinia faucibus mauris, et tempor urna tempor sed. Integer  dictum arcu ut nunc aliquet euismod. \nPraesent ut augue in metus  dignissim viverra.</p>', null, 'Confirmation', '', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-09-12 17:28:19');
INSERT INTO `fe_Pages` VALUES ('8814', '3', '1', '8bea08cd-8de9-09af-3dff-7e184fbda66f', '33', 'personal-account', '22', null, null, '', '1', 'пиздецммм', null, 'Personal Account', '', null, null, null, 'Saving an error - data is stored.', 'Data saved successfully', '{SITE_URL_PAGES}home.php?pagecode=home&lang=en', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2014-06-20 16:23:32');
INSERT INTO `fe_Pages` VALUES ('8817', '3', '1', '7b03ccfd-fc46-2d7a-0fc4-3e80e9344a45', '77', 'password-recovery', '22', '', '', '', '1', '<p style=\"text-align: center;\">New password has been sent to the specified e-mail</p>', null, 'Password recovery', '<p style=\"text-align: center;\">To receive a new password, you must enter the e-mail address that was specified at registration</p>', null, null, null, '<p style=\"text-align: center;\">This email does not exist</p>', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2013-10-16 10:36:17');
INSERT INTO `fe_Pages` VALUES ('8818', '3', '1', 'a2c65012-c5ec-88fe-4655-ea94b27bc9d5', '141', 'cancel', '22', '', '', '', '1', '<h2><center>Your order canceled!</center></h2>\n<p style=\"text-align: center;\">Aliquam sed odio fermentum, dictum libero quis, venenatis odio.  \nPhasellus sit amet ligula libero. Nam tempus diam neque, at tincidunt  metus eleifend sed. \nDonec luctus leo cursus imperdiet eleifend. Nam nec  tristique magna. Nunc dapibus sed turpis non accumsan. \nAenean eget nibh  leo. Aenean lacinia faucibus mauris, et tempor urna tempor sed. Integer  dictum arcu ut nunc aliquet euismod. \nPraesent ut augue in metus  dignissim viverra.</p>', null, 'Order canceled', '', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2014-02-03 16:21:36');
INSERT INTO `fe_Pages` VALUES ('8821', '3', '1', '2d701439-4b67-905a-22ec-c5bea28435cb', '142', 'list', '22', null, null, '', '1', 'This is your list of orders.', null, 'My orders', '', null, null, null, '', '', '', '', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '2014-06-20 17:06:36');

-- ----------------------------
-- Table structure for `fe_PagesRelatedItems`
-- ----------------------------
DROP TABLE IF EXISTS `fe_PagesRelatedItems`;
CREATE TABLE `fe_PagesRelatedItems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `langId` int(11) unsigned DEFAULT NULL,
  `viewId` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `shortDescription` varchar(255) DEFAULT NULL,
  `dateStartVisible` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `text1` varchar(255) DEFAULT NULL,
  `text2` varchar(255) DEFAULT NULL,
  `text3` varchar(255) DEFAULT NULL,
  `text4` varchar(1000) DEFAULT NULL,
  `text5` varchar(255) DEFAULT NULL,
  `number1` int(11) unsigned DEFAULT NULL,
  `number2` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of fe_PagesRelatedItems
-- ----------------------------
INSERT INTO `fe_PagesRelatedItems` VALUES ('100', null, '117', 'AREFEVA', 'The blouse that will make you even more beautiful, \nwill accentuate your personality and will give you improved sense of self-confidence. \nTake a look at our collection \nAnd maybe you\'ll find the blouse of your dreams ', '2013-06-18 15:42:36', '{SITE_URL}/frontend/webcontent/images/photos/01-homepage.jpg', 'DREAMING OF THE PERFECT BLOUSE?', null, null, null, null, null);
INSERT INTO `fe_PagesRelatedItems` VALUES ('101', null, '117', 'AREFEVA 2', 'New blouse that will make you even more beautiful,\nwill accentuate your personality and will give you improved sense of self-confidence. \nTake a look at our collection 2', '2013-06-18 15:42:09', '{SITE_URL}/frontend/webcontent/images/photos/03-homepage.jpg', 'DREAMING OF THE PERFECT BLOUSE? 2', null, null, null, null, null);
INSERT INTO `fe_PagesRelatedItems` VALUES ('102', null, '117', 'AREFEVA 3', 'The blouse that will make you even more beautiful,\nwill accentuate your personality \nAnd maybe you\'ll find the blouse of your dreams 3', '2013-10-07 14:41:06', '{SITE_URL}/frontend/webcontent/images/photos/02-homepage.jpg', 'DREAMING OF THE PERFECT BLOUSE? 3', null, null, null, null, null);

-- ----------------------------
-- Table structure for `fe_PaymentLog`
-- ----------------------------
DROP TABLE IF EXISTS `fe_PaymentLog`;
CREATE TABLE `fe_PaymentLog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) unsigned DEFAULT NULL,
  `orderId` int(11) unsigned NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `params` text,
  `type` varchar(50) DEFAULT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visitorIp` varchar(15) DEFAULT NULL,
  `traceStr` text,
  `request` text,
  `pageUrl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `orderId` (`orderId`),
  CONSTRAINT `fe_PaymentLog_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `fe_Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fe_PaymentLog_ibfk_2` FOREIGN KEY (`orderId`) REFERENCES `fe_Orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of fe_PaymentLog
-- ----------------------------

-- ----------------------------
-- Table structure for `fe_PaymentMethods`
-- ----------------------------
DROP TABLE IF EXISTS `fe_PaymentMethods`;
CREATE TABLE `fe_PaymentMethods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `websiteId` int(11) unsigned DEFAULT '1',
  `providerId` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(25) DEFAULT NULL,
  `attributeKey` varchar(25) DEFAULT NULL,
  `attributeValue` varchar(255) DEFAULT NULL,
  `attributeHint` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `orderNumber` int(11) DEFAULT '1',
  `active` int(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `providerId` (`providerId`),
  KEY `websiteId` (`websiteId`),
  CONSTRAINT `fe_PaymentMethods_ibfk_1` FOREIGN KEY (`providerId`) REFERENCES `fe_PaymentProviders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fe_PaymentMethods_ibfk_2` FOREIGN KEY (`websiteId`) REFERENCES `be_WebSites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of fe_PaymentMethods
-- ----------------------------
INSERT INTO `fe_PaymentMethods` VALUES ('1', '1', '1', 'CreditCard', 'CreditCard', null, '', null, 'https://secure.ogone.com/Ncol/Test/BackOffice/Content/core/Brand/Small/Eurocard_choice.gif', '1', '1');
INSERT INTO `fe_PaymentMethods` VALUES ('2', '1', '1', 'iDEAL', 'iDEAL', null, null, null, 'https://secure.ogone.com/Ncol/Test/BackOffice/Content/core/Brand/Small/iDeal_choice.gif', '2', '1');

-- ----------------------------
-- Table structure for `fe_PaymentProviders`
-- ----------------------------
DROP TABLE IF EXISTS `fe_PaymentProviders`;
CREATE TABLE `fe_PaymentProviders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `websiteId` int(11) unsigned DEFAULT '1',
  `title` varchar(255) DEFAULT NULL,
  `className` varchar(255) DEFAULT NULL,
  `merchantId` varchar(255) DEFAULT NULL,
  `secretKey` varchar(255) DEFAULT NULL,
  `hiddenKey` varchar(255) NOT NULL,
  `apiKey` varchar(255) NOT NULL,
  `successUrl` varchar(255) NOT NULL,
  `failUrl` varchar(255) NOT NULL,
  `resultUrl` varchar(255) NOT NULL,
  `currencyId` varchar(255) DEFAULT NULL,
  `order` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `websiteId` (`websiteId`),
  CONSTRAINT `fe_PaymentProviders_ibfk_1` FOREIGN KEY (`websiteId`) REFERENCES `be_WebSites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of fe_PaymentProviders
-- ----------------------------
INSERT INTO `fe_PaymentProviders` VALUES ('1', '1', 'Ogone', 'ogone', 'dreamblouses', 'f1ae2f24a762', 'ab10200de9fd0', '6f6836e0e1', '{SITE_URL}/frontend/handlers/payment_accept.php', '{SITE_URL_PAGES}sb_cancel.php?pagecode=cancel&lang=en', '{SITE_URL_PAGES}sb_confirmation.php?pagecode=confirmation&lang=en', '5', '2');

-- ----------------------------
-- Table structure for `fe_PaymentStatus`
-- ----------------------------
DROP TABLE IF EXISTS `fe_PaymentStatus`;
CREATE TABLE `fe_PaymentStatus` (
  `id` int(11) unsigned NOT NULL,
  `description` varchar(255) CHARACTER SET cp1251 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_PaymentStatus
-- ----------------------------
INSERT INTO `fe_PaymentStatus` VALUES ('1', 'in progress');
INSERT INTO `fe_PaymentStatus` VALUES ('2', 'success');
INSERT INTO `fe_PaymentStatus` VALUES ('3', 'fail');

-- ----------------------------
-- Table structure for `fe_PaymentStatusTranslations`
-- ----------------------------
DROP TABLE IF EXISTS `fe_PaymentStatusTranslations`;
CREATE TABLE `fe_PaymentStatusTranslations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `statusId` int(11) unsigned NOT NULL,
  `langId` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fe_PaymentStatusTranslations_fe_PaymentStatus` (`statusId`),
  CONSTRAINT `fk_fe_PaymentStatusTranslations_fe_PaymentStatus` FOREIGN KEY (`statusId`) REFERENCES `fe_PaymentStatus` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_PaymentStatusTranslations
-- ----------------------------
INSERT INTO `fe_PaymentStatusTranslations` VALUES ('1', '1', '3', 'in progress');
INSERT INTO `fe_PaymentStatusTranslations` VALUES ('4', '2', '3', 'success');
INSERT INTO `fe_PaymentStatusTranslations` VALUES ('5', '3', '3', 'fail');

-- ----------------------------
-- Table structure for `fe_ProductAttributeItems`
-- ----------------------------
DROP TABLE IF EXISTS `fe_ProductAttributeItems`;
CREATE TABLE `fe_ProductAttributeItems` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attributeId` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(250) DEFAULT NULL,
  `colorCode` varchar(11) DEFAULT NULL,
  `orderNr` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_attribute_attributeitem` (`attributeId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_ProductAttributeItems
-- ----------------------------
INSERT INTO `fe_ProductAttributeItems` VALUES ('3', '2', 'S', '', '0');
INSERT INTO `fe_ProductAttributeItems` VALUES ('4', '2', 'L', '', '0');
INSERT INTO `fe_ProductAttributeItems` VALUES ('5', '2', 'M', '', '0');
INSERT INTO `fe_ProductAttributeItems` VALUES ('6', '2', 'XL', '', '0');
INSERT INTO `fe_ProductAttributeItems` VALUES ('7', '1', 'Black', '#000000', '0');
INSERT INTO `fe_ProductAttributeItems` VALUES ('10', '1', 'White', '#ffffff', '0');
INSERT INTO `fe_ProductAttributeItems` VALUES ('12', '1', 'Beige', '#F5F5DC', '0');

-- ----------------------------
-- Table structure for `fe_ProductAttributeItemTranslations`
-- ----------------------------
DROP TABLE IF EXISTS `fe_ProductAttributeItemTranslations`;
CREATE TABLE `fe_ProductAttributeItemTranslations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attributeItemId` int(11) unsigned NOT NULL DEFAULT '0',
  `langId` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(250) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `attributeId_langId` (`attributeItemId`,`langId`),
  KEY `fk_lang_attribute` (`langId`),
  CONSTRAINT `fk_attritem_attritemtr` FOREIGN KEY (`attributeItemId`) REFERENCES `fe_ProductAttributeItems` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_lang_attritemtr` FOREIGN KEY (`langId`) REFERENCES `be_Languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_ProductAttributeItemTranslations
-- ----------------------------
INSERT INTO `fe_ProductAttributeItemTranslations` VALUES ('5', '7', '3', 'black', null);
INSERT INTO `fe_ProductAttributeItemTranslations` VALUES ('8', '3', '3', 'S-en', null);
INSERT INTO `fe_ProductAttributeItemTranslations` VALUES ('11', '4', '3', 'L', null);
INSERT INTO `fe_ProductAttributeItemTranslations` VALUES ('16', '5', '3', 'M', null);
INSERT INTO `fe_ProductAttributeItemTranslations` VALUES ('20', '6', '3', 'XL', null);
INSERT INTO `fe_ProductAttributeItemTranslations` VALUES ('24', '10', '3', 'White', null);
INSERT INTO `fe_ProductAttributeItemTranslations` VALUES ('27', '12', '3', 'Beige', null);

-- ----------------------------
-- Table structure for `fe_ProductAttributes`
-- ----------------------------
DROP TABLE IF EXISTS `fe_ProductAttributes`;
CREATE TABLE `fe_ProductAttributes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `storageFieldName` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_ProductAttributes
-- ----------------------------
INSERT INTO `fe_ProductAttributes` VALUES ('1', 'Color', 'attribute2ValueId');
INSERT INTO `fe_ProductAttributes` VALUES ('2', 'Size', 'attribute1ValueId');

-- ----------------------------
-- Table structure for `fe_ProductAttributeTranslations`
-- ----------------------------
DROP TABLE IF EXISTS `fe_ProductAttributeTranslations`;
CREATE TABLE `fe_ProductAttributeTranslations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attributeId` int(11) unsigned NOT NULL DEFAULT '0',
  `langId` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(250) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `attributeId_langId` (`attributeId`,`langId`),
  KEY `fk_lang_attribute` (`langId`),
  CONSTRAINT `fk_lang_productattrtr` FOREIGN KEY (`langId`) REFERENCES `be_Languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_productattr_productattrtr` FOREIGN KEY (`attributeId`) REFERENCES `fe_ProductAttributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_ProductAttributeTranslations
-- ----------------------------
INSERT INTO `fe_ProductAttributeTranslations` VALUES ('1', '1', '3', 'Color', null);
INSERT INTO `fe_ProductAttributeTranslations` VALUES ('3', '2', '3', 'Size', null);

-- ----------------------------
-- Table structure for `fe_ProductCategories`
-- ----------------------------
DROP TABLE IF EXISTS `fe_ProductCategories`;
CREATE TABLE `fe_ProductCategories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `websiteId` int(11) unsigned DEFAULT NULL,
  `viewId` int(11) unsigned DEFAULT NULL,
  `rootId` int(11) unsigned DEFAULT NULL,
  `parentId` int(11) unsigned DEFAULT NULL,
  `treeItemName` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `visible` tinyint(3) unsigned DEFAULT '1',
  `orderNumber` int(11) DEFAULT '1',
  `isTemp` binary(1) NOT NULL DEFAULT '1',
  `codeName` varchar(255) DEFAULT NULL,
  `text1` varchar(255) NOT NULL,
  `text2` varchar(255) NOT NULL,
  `text3` varchar(255) NOT NULL,
  `number1` int(11) unsigned DEFAULT NULL,
  `number2` int(11) unsigned DEFAULT NULL,
  `number3` int(11) DEFAULT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `rootId` (`rootId`),
  KEY `parentId` (`parentId`),
  KEY `fk_website_productcat` (`websiteId`),
  CONSTRAINT `fk_website_productcat` FOREIGN KEY (`websiteId`) REFERENCES `be_WebSites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_ProductCategories
-- ----------------------------
INSERT INTO `fe_ProductCategories` VALUES ('1', null, null, '1', '0', null, null, null, '1', '0', 0x30, null, '', '', '', null, null, null, '2013-08-14 15:07:35');
INSERT INTO `fe_ProductCategories` VALUES ('4', '1', '17', '1', '1', 'BODY-BLOUSE', 'BODY-BLOUSE', null, '1', '1', 0x30, 'body-blouse', '', '', '', null, '9', null, '2013-09-27 12:14:16');
INSERT INTO `fe_ProductCategories` VALUES ('8', '1', '17', '1', '1', 'DRESS', 'DRESS', null, '1', '2', 0x30, 'dress', '', '', '', null, '9', null, '2013-09-27 12:14:32');
INSERT INTO `fe_ProductCategories` VALUES ('9', '1', '17', '1', '1', 'OUTLET', 'OUTLET', null, '1', '3', 0x30, 'outlet', '', '', '', null, '20', null, '2013-10-07 14:45:10');

-- ----------------------------
-- Table structure for `fe_ProductCategoryTranslations`
-- ----------------------------
DROP TABLE IF EXISTS `fe_ProductCategoryTranslations`;
CREATE TABLE `fe_ProductCategoryTranslations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `categoryId` int(11) unsigned NOT NULL DEFAULT '0',
  `langId` int(10) unsigned NOT NULL DEFAULT '0',
  `masterPageId` int(11) unsigned DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `description` text,
  `seoTitle` varchar(100) DEFAULT NULL,
  `seoDescription` varchar(255) DEFAULT NULL,
  `seoKeywords` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categoryId_langId` (`categoryId`,`langId`),
  KEY `fk_lang_categoryitemt` (`langId`),
  CONSTRAINT `fk_catId_productcattr` FOREIGN KEY (`categoryId`) REFERENCES `fe_ProductCategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_lang_productcattr` FOREIGN KEY (`langId`) REFERENCES `be_Languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_ProductCategoryTranslations
-- ----------------------------
INSERT INTO `fe_ProductCategoryTranslations` VALUES ('4', '4', '3', '22', 'BODY-BLOUSE', 'Nullam vitae elit eget arcu faucibus sagittis. Nullam odio orci, fermentum sed purus et, commodo accumsan lacus. Curabitur ullamcorper eleifend metus, at tincidunt lacus pellentesque vitae. Aenean at nibh viverra, aliquam diam et, ultricies ante. Integer ut ipsum dui. Aenean id arcu vel velit dignissim tincidunt sit amet non ligula. Maecenas in commodo metus, vitae scelerisque sem.', '', '', '');
INSERT INTO `fe_ProductCategoryTranslations` VALUES ('13', '8', '3', '26', 'DRESS', 'Nullam vitae elit eget arcu faucibus sagittis. Nullam odio orci, fermentum sed purus et, commodo accumsan lacus. Curabitur ullamcorper eleifend metus, at tincidunt lacus pellentesque vitae. Aenean at nibh viverra, aliquam diam et, ultricies ante. Integer ut ipsum dui. Aenean id arcu vel velit dignissim tincidunt sit amet non ligula. Maecenas in commodo metus, vitae scelerisque sem.', '', '', '');
INSERT INTO `fe_ProductCategoryTranslations` VALUES ('15', '9', '3', '26', 'OUTLET', 'Nullam vitae elit eget arcu faucibus sagittis. Nullam odio orci, fermentum sed purus et, commodo accumsan lacus. Curabitur ullamcorper eleifend metus, at tincidunt lacus pellentesque vitae. Aenean at nibh viverra, aliquam diam et, ultricies ante. Integer ut ipsum dui. Aenean id arcu vel velit dignissim tincidunt sit amet non ligula. Maecenas in commodo metus, vitae scelerisque sem. ', '', '', '');

-- ----------------------------
-- Table structure for `fe_ProductImages`
-- ----------------------------
DROP TABLE IF EXISTS `fe_ProductImages`;
CREATE TABLE `fe_ProductImages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `viewId` int(11) unsigned DEFAULT NULL,
  `productId` int(10) unsigned NOT NULL DEFAULT '0',
  `imageSmall` varchar(255) DEFAULT '',
  `image` varchar(255) DEFAULT '',
  `imageBig` varchar(255) DEFAULT NULL,
  `orderNr` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_view_productimage` (`viewId`),
  KEY `fk_product_productimage` (`productId`),
  CONSTRAINT `fk_product_productimages` FOREIGN KEY (`productId`) REFERENCES `fe_Products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_view_productimages` FOREIGN KEY (`viewId`) REFERENCES `be_View` (`viewId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_ProductImages
-- ----------------------------
INSERT INTO `fe_ProductImages` VALUES ('92', '57', '42', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b50382-1.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b50382-1.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b50382-1.jpg', '1');
INSERT INTO `fe_ProductImages` VALUES ('93', '57', '42', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b50383-2.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b50383-2.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b50383-2.jpg', '2');
INSERT INTO `fe_ProductImages` VALUES ('94', '57', '42', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b50384-3.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b50384-3.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b50384-3.jpg', '3');
INSERT INTO `fe_ProductImages` VALUES ('95', '57', '42', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b50385-4.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b50385-4.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b50385-4.jpg', '4');
INSERT INTO `fe_ProductImages` VALUES ('96', '57', '41', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b0910w1-1.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b0910w1-1.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b0910w1-1.jpg', '1');
INSERT INTO `fe_ProductImages` VALUES ('97', '57', '41', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b0910w2-2.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b0910w2-2.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b0910w2-2.jpg', '2');
INSERT INTO `fe_ProductImages` VALUES ('98', '57', '41', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b0910w3-3.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b0910w3-3.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b0910w3-3.jpg', '3');
INSERT INTO `fe_ProductImages` VALUES ('99', '57', '41', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b0910w4-4.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b0910w4-4.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b0910w4-4.jpg', '4');
INSERT INTO `fe_ProductImages` VALUES ('100', '57', '40', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_tu20971-1.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_tu20971-1.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_tu20971-1.jpg', '1');
INSERT INTO `fe_ProductImages` VALUES ('101', '57', '40', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_tu20972-2.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_tu20972-2.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_tu20972-2.jpg', '2');
INSERT INTO `fe_ProductImages` VALUES ('102', '57', '40', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_tu20973-3.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_tu20973-3.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_tu20973-3.jpg', '3');
INSERT INTO `fe_ProductImages` VALUES ('103', '57', '40', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_tu20974-4.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_tu20974-4.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_tu20974-4.jpg', '4');
INSERT INTO `fe_ProductImages` VALUES ('104', '57', '39', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b0910w1-1.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b0910w1-1.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b0910w1-1.jpg', '1');
INSERT INTO `fe_ProductImages` VALUES ('105', '57', '39', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b0910w2-2.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b0910w2-2.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b0910w2-2.jpg', '2');
INSERT INTO `fe_ProductImages` VALUES ('106', '57', '39', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b0910w3-3.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b0910w3-3.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b0910w3-3.jpg', '3');
INSERT INTO `fe_ProductImages` VALUES ('107', '57', '39', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b0910w4-4.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b0910w4-4.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b0910w4-4.jpg', '4');
INSERT INTO `fe_ProductImages` VALUES ('108', '57', '35', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b0910w1-1.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b0910w1-1.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b0910w1-1.jpg', '1');
INSERT INTO `fe_ProductImages` VALUES ('109', '57', '35', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b0910w2-2.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b0910w2-2.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b0910w2-2.jpg', '2');
INSERT INTO `fe_ProductImages` VALUES ('110', '57', '35', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b0910w3-3.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b0910w3-3.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b0910w3-3.jpg', '3');
INSERT INTO `fe_ProductImages` VALUES ('111', '57', '35', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b0910w4-4.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b0910w4-4.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b0910w4-4.jpg', '4');
INSERT INTO `fe_ProductImages` VALUES ('112', '57', '28', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b50382-1.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b50382-1.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b50382-1.jpg', '1');
INSERT INTO `fe_ProductImages` VALUES ('113', '57', '28', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b50383-2.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b50383-2.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b50383-2.jpg', '2');
INSERT INTO `fe_ProductImages` VALUES ('114', '57', '28', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b50384-3.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b50384-3.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b50384-3.jpg', '3');
INSERT INTO `fe_ProductImages` VALUES ('115', '57', '28', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b50385-4.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b50385-4.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b50385-4.jpg', '4');
INSERT INTO `fe_ProductImages` VALUES ('116', '57', '27', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_tu20971-1.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_tu20971-1.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_tu20971-1.jpg', '1');
INSERT INTO `fe_ProductImages` VALUES ('117', '57', '27', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_tu20972-2.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_tu20972-2.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_tu20972-2.jpg', '2');
INSERT INTO `fe_ProductImages` VALUES ('118', '57', '27', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_tu20973-3.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_tu20973-3.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_tu20973-3.jpg', '3');
INSERT INTO `fe_ProductImages` VALUES ('119', '57', '27', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_tu20974-4.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_tu20974-4.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_tu20974-4.jpg', '4');
INSERT INTO `fe_ProductImages` VALUES ('120', '57', '25', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b0910w1-1.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b0910w1-1.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b0910w1-1.jpg', '1');
INSERT INTO `fe_ProductImages` VALUES ('121', '57', '25', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b0910w2-2.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b0910w2-2.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b0910w2-2.jpg', '2');
INSERT INTO `fe_ProductImages` VALUES ('122', '57', '25', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b0910w3-3.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b0910w3-3.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b0910w3-3.jpg', '3');
INSERT INTO `fe_ProductImages` VALUES ('123', '57', '25', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b0910w4-4.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b0910w4-4.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b0910w4-4.jpg', '4');
INSERT INTO `fe_ProductImages` VALUES ('124', '57', '37', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b50382-1.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b50382-1.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b50382-1.jpg', '1');
INSERT INTO `fe_ProductImages` VALUES ('125', '57', '37', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b50383-2.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b50383-2.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b50383-2.jpg', '2');
INSERT INTO `fe_ProductImages` VALUES ('126', '57', '37', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b50384-3.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b50384-3.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b50384-3.jpg', '3');
INSERT INTO `fe_ProductImages` VALUES ('127', '57', '37', '{SITE_URL}/frontend/webcontent/images/photo_product/_231x348_b50385-4.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_401x604_b50385-4.jpg', '{SITE_URL}/frontend/webcontent/images/photo_product/_800x1200_b50385-4.jpg', '4');

-- ----------------------------
-- Table structure for `fe_ProductRelatedItems`
-- ----------------------------
DROP TABLE IF EXISTS `fe_ProductRelatedItems`;
CREATE TABLE `fe_ProductRelatedItems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `langId` int(11) unsigned DEFAULT NULL,
  `viewId` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `shortDescription` varchar(255) DEFAULT NULL,
  `text1` text,
  `text2` text,
  `text3` varchar(225) DEFAULT NULL,
  `text4` varchar(255) DEFAULT NULL,
  `text5` varchar(255) DEFAULT NULL,
  `number1` int(11) unsigned DEFAULT NULL,
  `number2` int(11) unsigned DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `contentId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_view_productrelateditems` (`viewId`),
  KEY `fk_lang_productitems` (`langId`),
  CONSTRAINT `fk_lang_productitems` FOREIGN KEY (`langId`) REFERENCES `be_Languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_view_productrelateditems` FOREIGN KEY (`viewId`) REFERENCES `be_View` (`viewId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_ProductRelatedItems
-- ----------------------------

-- ----------------------------
-- Table structure for `fe_Products`
-- ----------------------------
DROP TABLE IF EXISTS `fe_Products`;
CREATE TABLE `fe_Products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `websiteId` int(11) unsigned DEFAULT NULL,
  `viewId` int(11) unsigned DEFAULT NULL,
  `codeName` varchar(255) DEFAULT NULL,
  `visible` tinyint(3) DEFAULT '1',
  `categoryId` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `price` float(10,2) DEFAULT NULL,
  `oldPrice` float(10,2) DEFAULT NULL,
  `itemNumber` varchar(255) DEFAULT NULL,
  `dateEndVisible` timestamp NULL DEFAULT NULL,
  `text1` text,
  `text2` varchar(255) DEFAULT NULL,
  `text3` varchar(255) DEFAULT NULL,
  `text4` varchar(255) DEFAULT NULL,
  `number1` int(11) unsigned DEFAULT NULL,
  `number2` int(11) unsigned DEFAULT NULL,
  `number3` int(11) DEFAULT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `imageSmall` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `dateStartVisible` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `viewId` (`viewId`),
  KEY `fk_categories_product` (`categoryId`),
  KEY `fk_website_product` (`websiteId`),
  CONSTRAINT `fk_productcat_product` FOREIGN KEY (`categoryId`) REFERENCES `fe_ProductCategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_view_product` FOREIGN KEY (`viewId`) REFERENCES `be_View` (`viewId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_website_product` FOREIGN KEY (`websiteId`) REFERENCES `be_WebSites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_Products
-- ----------------------------
INSERT INTO `fe_Products` VALUES ('25', '1', '46', 'body-blouse', '1', '4', 'Body Blouse', '65.00', '15.12', 'B0910W', null, null, null, null, null, '4', null, '1', '2014-02-13 12:03:51', null, null, null);
INSERT INTO `fe_Products` VALUES ('27', '1', '46', 'dress', '1', '8', 'Dress', '81.00', '0.00', 'TU2097', null, null, null, null, null, '4', null, '1', '2013-09-23 18:19:48', null, null, null);
INSERT INTO `fe_Products` VALUES ('28', '1', '46', 'body-blouse', '1', '4', 'Body Blouse', '75.00', '0.00', 'B5038', null, null, null, null, null, '4', null, '1', '2013-09-23 18:22:20', null, null, null);
INSERT INTO `fe_Products` VALUES ('35', '1', '46', 'body-blouse2', '1', '4', 'Body Blouse2', '65.00', '0.00', 'B0910W', null, null, null, null, null, '4', null, '1', '2013-09-23 18:18:06', null, null, null);
INSERT INTO `fe_Products` VALUES ('37', '1', '46', 'body-blouse3', '1', '4', 'Body Blouse3', '75.00', '0.00', 'B5038', null, null, null, null, null, '4', null, '1', '2013-09-23 18:22:53', null, null, null);
INSERT INTO `fe_Products` VALUES ('39', '1', '46', 'body-blouse4', '1', '9', 'Body Blouse4', '65.00', '70.00', 'B0910W', null, null, null, null, null, '4', null, '1', '2013-10-07 14:47:59', null, null, null);
INSERT INTO `fe_Products` VALUES ('40', '1', '46', 'dress2', '1', '8', 'Dress2', '81.00', '0.00', 'TU2097', null, null, null, null, null, '4', null, '1', '2013-09-23 18:26:33', null, null, null);
INSERT INTO `fe_Products` VALUES ('41', '1', '46', 'dress3', '1', '8', 'Dress3', '65.00', '0.00', 'B0910W', null, null, null, null, null, '4', null, '1', '2013-09-23 18:30:09', null, null, null);
INSERT INTO `fe_Products` VALUES ('42', '1', '46', 'dress4', '1', '8', 'Dress4', '75.00', '0.00', 'B5038', null, null, null, null, null, '4', null, '1', '2013-09-23 18:31:17', null, null, null);
INSERT INTO `fe_Products` VALUES ('43', '1', '46', 'test', '1', '4', 'тест', '0.00', '0.00', '1', null, null, null, null, null, '4', null, '1', '2014-07-14 16:36:46', null, null, null);
INSERT INTO `fe_Products` VALUES ('44', '1', '46', 'test', '1', '4', 'тест', '0.00', '0.00', '1', null, null, null, null, null, '4', null, '1', '2014-07-14 16:36:50', null, null, null);

-- ----------------------------
-- Table structure for `fe_ProductTranslations`
-- ----------------------------
DROP TABLE IF EXISTS `fe_ProductTranslations`;
CREATE TABLE `fe_ProductTranslations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `productId` int(11) unsigned NOT NULL DEFAULT '0',
  `langId` int(10) unsigned NOT NULL DEFAULT '0',
  `masterPageId` int(11) unsigned DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `shortDescription` varchar(255) DEFAULT NULL,
  `html` text,
  `material` varchar(255) DEFAULT NULL,
  `seoTitle` varchar(100) DEFAULT NULL,
  `seoDescription` varchar(255) DEFAULT NULL,
  `seoKeywords` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productId_langId` (`productId`,`langId`),
  KEY `fk_lang_productitemt` (`langId`),
  CONSTRAINT `fk_lang_producttr` FOREIGN KEY (`langId`) REFERENCES `be_Languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_producttr` FOREIGN KEY (`productId`) REFERENCES `fe_Products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_ProductTranslations
-- ----------------------------
INSERT INTO `fe_ProductTranslations` VALUES ('37', '25', '3', '22', 'Body Blouse', null, 'Very elegant model for various occasions: in combination with jeans or classic skirt. This model is slightly transparent.', null, '', '', '');
INSERT INTO `fe_ProductTranslations` VALUES ('40', '27', '3', '22', 'Dress', null, 'This elegant dress with short sleeves with elements of French lace will perfectly fits the shape of your body due to the strtch material. This would be an excellent choice for a special occasion or for an everyday look. <b>Dress Length is</b> : sizes S and M : 89,5 cm; size L: 91 cm.', null, '', '', '');
INSERT INTO `fe_ProductTranslations` VALUES ('42', '28', '3', '22', 'Body Blouse', null, 'The trend of the season:  the combination of the beige and black colors. Amazingly soft and slightly stretch French lace will not only be pleasant to wear, but will also look very luxurious. In combination with jeans or create a classic look.', '85% Polyamide, 15% Elastane', '', '', '');
INSERT INTO `fe_ProductTranslations` VALUES ('56', '35', '3', '22', 'Body Blouse2', null, 'Very elegant model for various occasions: in combination with jeans or classic skirt. This model is slightly transparent.', null, '', '', '');
INSERT INTO `fe_ProductTranslations` VALUES ('59', '37', '3', '22', 'Body Blouse3', null, 'The trend of the season:  the combination of the beige and black colors. Amazingly soft and slightly stretch French lace will not only be pleasant to wear, but will also look very luxurious. In combination with jeans or create a classic look.', '85% Polyamide, 15% Elastane', '', '', '');
INSERT INTO `fe_ProductTranslations` VALUES ('61', '39', '3', '22', 'Body Blouse4', null, 'Very elegant model for various occasions: in combination with jeans or classic skirt. This model is slightly transparent.', null, '', '', '');
INSERT INTO `fe_ProductTranslations` VALUES ('63', '40', '3', '22', 'Dress2', null, 'This elegant dress with short sleeves with elements of French lace will perfectly fits the shape of your body due to the strtch material. This would be an excellent choice for a special occasion or for an everyday look. <b>Dress Length is</b> : sizes S and M : 89,5 cm; size L: 91 cm.', null, '', '', '');
INSERT INTO `fe_ProductTranslations` VALUES ('65', '41', '3', '22', 'Dress3', null, 'Very elegant model for various occasions: in combination with jeans or classic skirt. This model is slightly transparent.', null, '', '', '');
INSERT INTO `fe_ProductTranslations` VALUES ('67', '42', '3', '22', 'Dress4', null, 'The trend of the season:  the combination of the beige and black colors. Amazingly soft and slightly stretch French lace will not only be pleasant to wear, but will also look very luxurious. In combination with jeans or create a classic look.', '85% Polyamide, 15% Elastane 42', '', '', '');

-- ----------------------------
-- Table structure for `fe_ProductVariations`
-- ----------------------------
DROP TABLE IF EXISTS `fe_ProductVariations`;
CREATE TABLE `fe_ProductVariations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `productId` int(11) unsigned NOT NULL DEFAULT '0',
  `attribute1ValueId` int(10) unsigned NOT NULL DEFAULT '0',
  `attribute2ValueId` int(10) unsigned NOT NULL DEFAULT '0',
  `price` float(10,2) unsigned DEFAULT '0.00',
  `stock` int(11) DEFAULT '0',
  `imageSmall` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `text1` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productId_attr1_attr2` (`productId`,`attribute1ValueId`,`attribute2ValueId`),
  KEY `fk_product_productvariation` (`productId`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_ProductVariations
-- ----------------------------
INSERT INTO `fe_ProductVariations` VALUES ('13', '25', '3', '10', '0.00', '5', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('14', '25', '5', '10', '0.00', '3', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('15', '25', '4', '10', '0.00', '4', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('16', '25', '6', '10', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('17', '27', '3', '7', '0.00', '12', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('18', '27', '3', '10', '0.00', '10', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('19', '27', '5', '7', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('20', '27', '5', '10', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('21', '27', '4', '7', '0.00', '5', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('22', '27', '4', '10', '0.00', '18', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('23', '28', '3', '7', '0.00', '10', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('24', '28', '5', '7', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('25', '28', '4', '7', '0.00', '5', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('26', '28', '3', '12', '0.00', '56', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('27', '28', '4', '12', '0.00', '17', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('28', '28', '5', '12', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('65', '35', '3', '10', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('67', '35', '5', '10', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('68', '35', '4', '10', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('69', '35', '6', '10', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('70', '37', '3', '7', '0.00', '2', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('71', '37', '3', '12', '0.00', '4', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('72', '37', '4', '7', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('73', '37', '4', '12', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('74', '37', '5', '7', '0.00', '25', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('75', '37', '5', '12', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('76', '39', '3', '10', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('77', '39', '4', '10', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('78', '39', '5', '10', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('79', '39', '6', '10', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('80', '40', '3', '7', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('81', '40', '3', '10', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('82', '40', '4', '7', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('84', '40', '4', '10', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('85', '40', '5', '7', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('86', '40', '5', '10', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('87', '41', '3', '10', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('88', '41', '4', '10', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('89', '41', '5', '10', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('90', '41', '6', '10', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('91', '42', '3', '7', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('92', '42', '3', '12', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('93', '42', '4', '7', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('95', '42', '4', '12', '0.00', '55', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('96', '42', '5', '7', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('97', '42', '5', '12', '0.00', '0', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('100', '42', '3', '10', '0.00', '5', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('105', '77', '7', '3', '0.00', '10', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('106', '77', '7', '4', '0.00', '10', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('107', '77', '10', '3', '0.00', '10', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('108', '77', '10', '4', '0.00', '10', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('109', '43', '3', '7', '0.00', '10', null, null, null);
INSERT INTO `fe_ProductVariations` VALUES ('110', '44', '3', '7', '0.00', '10', null, null, null);

-- ----------------------------
-- Table structure for `fe_UserMessages`
-- ----------------------------
DROP TABLE IF EXISTS `fe_UserMessages`;
CREATE TABLE `fe_UserMessages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `senderId` int(11) unsigned DEFAULT NULL,
  `recipientId` int(11) unsigned DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accepted` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_users_usermasages` (`senderId`),
  CONSTRAINT `fk_users_usermasages` FOREIGN KEY (`senderId`) REFERENCES `fe_Users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of fe_UserMessages
-- ----------------------------

-- ----------------------------
-- Table structure for `fe_Users`
-- ----------------------------
DROP TABLE IF EXISTS `fe_Users`;
CREATE TABLE `fe_Users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `viewId` int(11) unsigned NOT NULL DEFAULT '0',
  `loginName` varchar(50) CHARACTER SET cp1251 DEFAULT NULL,
  `password` varchar(50) CHARACTER SET cp1251 DEFAULT NULL,
  `password1` varchar(50) CHARACTER SET cp1251 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET cp1251 DEFAULT NULL,
  `name` varchar(50) CHARACTER SET cp1251 DEFAULT NULL,
  `surname` varchar(50) CHARACTER SET cp1251 DEFAULT NULL,
  `patronymic` varchar(255) CHARACTER SET cp1251 DEFAULT NULL,
  `phoneNumber` varchar(20) CHARACTER SET cp1251 DEFAULT NULL,
  `icq` varchar(50) CHARACTER SET cp1251 DEFAULT NULL,
  `skype` varchar(50) CHARACTER SET cp1251 DEFAULT NULL,
  `ip` varchar(16) CHARACTER SET cp1251 DEFAULT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastVisitDate` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `text1` varchar(255) CHARACTER SET cp1251 DEFAULT NULL,
  `text2` varchar(255) CHARACTER SET cp1251 DEFAULT NULL,
  `text3` varchar(255) CHARACTER SET cp1251 DEFAULT NULL,
  `text4` varchar(255) CHARACTER SET cp1251 DEFAULT NULL,
  `text5` text CHARACTER SET cp1251,
  `number1` int(11) DEFAULT NULL,
  `number2` int(11) DEFAULT NULL,
  `guid` varchar(36) CHARACTER SET cp1251 DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET cp1251 DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `websiteId` int(11) unsigned DEFAULT NULL,
  `isJuridicalPerson` int(2) NOT NULL DEFAULT '0',
  `isSubscriber` int(2) NOT NULL DEFAULT '0',
  `gender` int(1) NOT NULL DEFAULT '0',
  `defaultAddressId` int(11) unsigned DEFAULT NULL COMMENT 'main billing address, edited only from user profile',
  `langId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`loginName`),
  UNIQUE KEY `email_unique` (`email`),
  KEY `fk_Users_Websites` (`websiteId`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fe_Users
-- ----------------------------
INSERT INTO `fe_Users` VALUES ('20', '36', null, '098f6bcd4621d373cade4e832627b4f6', null, 'rjhdsy@gmail.com', 'Karl', 'Kori', null, '0939944760', null, null, null, '2013-09-17 15:07:57', '2014-02-05 00:00:00', '1', null, null, null, null, null, null, null, '81964dde-fb90-4702-207c-e9601c5f4e64', null, '2013-09-10', '1', '0', '1', '1', '13', '0');
INSERT INTO `fe_Users` VALUES ('56', '36', null, '098f6bcd4621d373cade4e832627b4f6', null, 'rjh.dsy@gmail.com', 'test', 'test', null, '', null, null, null, '2013-09-26 15:49:36', '2013-09-26 00:00:00', '1', null, null, null, null, null, null, null, 'ab3e57d4-743e-5336-9329-4e14141b2ec5', null, '1970-01-01', '1', '0', '1', '1', '32', '0');
INSERT INTO `fe_Users` VALUES ('70', '36', null, 'f5bb0c8de146c67b44babbf4e6584cc0', null, 'm.melnichuk@iproaction.com', 'Max', 'Melissen', null, '', null, null, null, '2013-10-01 19:02:41', '2014-02-27 00:00:00', '1', null, null, null, null, null, null, null, '5a756d4d-9846-59f7-ffd1-b748c117648c', null, '1970-01-01', '1', '0', '1', '1', '78', '0');
INSERT INTO `fe_Users` VALUES ('71', '36', null, 'f5bb0c8de146c67b44babbf4e6584cc0', null, 'maxisfighter@gmail.com', 'Max', 'Fighter', null, '', null, null, null, '2013-10-01 20:57:15', '2014-01-15 00:00:00', '1', null, null, null, null, null, null, null, '11d6b175-a645-5207-d917-d9fcac2fde0b', null, '1970-01-01', '1', '0', '1', '1', '38', '0');
INSERT INTO `fe_Users` VALUES ('82', '36', null, '12a69ccd93a10f98d84e1db731246d8c', null, 's.kondratovec@gmail.com', 'Sergey', 'Kondratovec', null, '5833328', null, null, null, '2013-12-02 17:35:18', '2014-02-08 00:00:00', '1', null, null, null, null, null, null, null, '6880d7c3-2cc5-87bb-2da1-157c406e17fc', null, '1970-01-01', '1', '0', '0', '1', '50', '0');
INSERT INTO `fe_Users` VALUES ('84', '36', null, 'e780824a8eff924c3e11f343eb898bfa', null, 'geniaderkach@rambler.ru', 'Eugeniyкууу', 'Derkachккккк', null, '', null, null, null, '2013-12-20 14:55:30', '2013-12-20 00:00:00', '1', null, null, null, null, null, null, null, 'f1b0c144-c903-4bbb-6552-583219b9e87e', null, '2013-12-18', '1', '0', '1', '1', '53', '0');
INSERT INTO `fe_Users` VALUES ('91', '36', null, '098f6bcd4621d373cade4e832627b4f6', null, 'geniaderkach@gmail.com', 'eugen', 'derkach62', null, '06873306099', null, null, null, '2013-12-20 17:57:26', '2014-06-20 00:00:00', '1', null, null, null, null, null, null, null, '43348b1b-06f0-420f-dde4-fabe316c20b4', null, '2014-01-31', '1', '0', '1', '2', '71', '0');
INSERT INTO `fe_Users` VALUES ('98', '36', null, '098f6bcd4621d373cade4e832627b4f6', null, 'korvin00@ukr.net', 'Sergiy', 'Dragunov', null, '', null, null, null, '2014-02-04 16:00:51', '2014-03-10 00:00:00', '1', null, null, null, null, null, null, null, '19e4a3f3-c5f0-b551-231c-2b91fb94eba4', null, '1970-01-01', '1', '0', '1', '1', '76', '0');
INSERT INTO `fe_Users` VALUES ('99', '36', null, '7a12a47984333222320df4510947fbdd', null, 'iproaction@gmail.com', 'Andrew', 'Grischuk', null, '', null, null, null, '2014-07-10 14:42:53', '2014-07-10 00:00:00', '1', null, null, null, null, null, null, null, '78abf0a5-a9c8-85b3-9972-c1fd40edf13f', null, '1983-10-15', '1', '0', '0', '1', '80', '0');
INSERT INTO `fe_Users` VALUES ('100', '36', null, '2d503a71112be2954cbee705718a5c32', null, 'iwanip@gmail.com', 'iwan', 'iwan', null, '1234356', null, null, null, '2014-07-14 16:46:02', '2014-07-14 00:00:00', '1', null, null, null, null, null, null, null, '1bfdb29a-ff3c-77e6-e2fc-0a3c65a9e96d', null, '2014-07-26', '1', '0', '1', '1', '81', '3');

-- ----------------------------
-- Table structure for `fe_WebText`
-- ----------------------------
DROP TABLE IF EXISTS `fe_WebText`;
CREATE TABLE `fe_WebText` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `viewId` bigint(11) unsigned NOT NULL DEFAULT '29',
  `langId` int(10) unsigned DEFAULT NULL,
  `keyword` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `remark` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `exported` tinyint(1) DEFAULT '1',
  `websiteId` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `keyword` (`keyword`)
) ENGINE=MyISAM AUTO_INCREMENT=2036 DEFAULT CHARSET=cp1251 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of fe_WebText
-- ----------------------------
INSERT INTO `fe_WebText` VALUES ('1762', '29', '3', 'USERS_EXPORT_EXCEL', 'Export users', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1763', '29', '3', 'USERS_EXPORT_EXCEL_TASK', 'Process showing export users', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1764', '29', '3', 'task_title', 'Title', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1765', '29', '3', 'task_status', 'Прогрес', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1766', '29', '3', 'task_start', 'Start process', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1767', '29', '3', 'task_end', 'End of process', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1768', '29', '3', 'task_start_button', 'Begin', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1769', '29', '3', 'task_params', 'Parameters', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1770', '29', '3', 'task_params_file_upload}*', 'Завантажити', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1771', '29', '3', 'SELECT_EXPORT_FIELD', 'Select export fields', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1772', '29', '3', 'mail_cron_finished', 'Process was successfully completed', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1773', '29', '3', 'download_file', 'Download report', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1774', '29', '3', 'WEBSITE_TITLE_PREFIX', '', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1775', '29', '3', 'siteSearch', 'Search', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1776', '29', '3', 'joinOurTxt', 'JOIN OUR ', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1777', '29', '3', 'newsLetterTxt', 'NEWSLETTER', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1778', '29', '3', 'BE_applyModerationBtn}*', 'Підтвердити', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1779', '29', '3', 'BE_refuseModerationBtn}*', 'Відхилити', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1780', '29', '3', 'BE_refuseReasonTxt}*', 'Причина:', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1781', '29', '3', 'registerPageNeedHelpTxt', 'Need help?', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1782', '29', '3', 'registerPageNeedHelpDescTxt', 'Our Customer Service team will be happy to help - just call 123 321 123', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1783', '29', '3', 'OrderProgressIndicatorSignInRegisterText', 'Sign in / Register', 'Pages with checkout steps', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1784', '29', '3', 'OrderProgressIndicatorBillingShippingText', 'Billing / Shipping', 'Pages with checkout steps', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1785', '29', '3', 'OrderProgressIndicatorOrderOverviewText', 'Order overview', 'Pages with checkout steps', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1786', '29', '3', 'OrderProgressIndicatorConfirmationText', 'Confirmation', 'Pages with checkout steps', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1787', '29', '3', 'basketAddressesDetailsTitle', 'Your details', 'Order overview page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1788', '29', '3', 'basketBillToAddressTitle', 'Bill to address', 'Order overview page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1789', '29', '3', 'basketAddressChangeTitle', '(change)', 'Order overview page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1790', '29', '3', 'basketShipToAddressTitle', 'Ship to address', 'Order overview page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1791', '29', '3', 'ShoppingBagEmptyText', 'No items in your basket', 'Shopping bag page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1792', '29', '3', 'shopping-cart-new-product-added', 'NEW PRODUCT ADDED', 'Shopping cart popup header text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1793', '29', '3', 'shopping-cart-product-size', 'Size: ', 'Shopping cart popup text for size label', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1794', '29', '3', 'shopping-cart-product-color', 'Color: ', 'Shopping cart popup text for color label', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1795', '29', '3', 'shopping-cart-proceed-to-checkout', 'PROCEED TO CHECKOUT', 'Shopping cart popup checkout button text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1796', '29', '3', 'ValidationContactFormEmailFormat', 'Wrong email format', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1797', '29', '3', 'RequiredFieldIsEmpty', 'The field is required', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1798', '29', '3', 'login_notvalid_error', 'Username or password incorrect', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1799', '29', '3', 'enter', 'Enter', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1800', '29', '3', 'register', '?????????', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1801', '29', '3', 'closeenter', 'Close', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1802', '29', '3', 'rememberMe', 'Remember me', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1803', '29', '3', 'remindPassword', 'Remind password', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1804', '29', '3', 'privateOfficeTxt', 'Private office', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1805', '29', '3', 'signIn', 'SING IN', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1806', '29', '3', 'logOut', 'Log out', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1807', '29', '3', 'paging_first_page', 'Перша сторінка', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1808', '29', '3', 'paging_prev_page', 'Попередня сторінка', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1809', '29', '3', 'paging_next_page', 'Наступна сторінка', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1810', '29', '3', 'paging_end_page', 'Остання сторінка', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1811', '29', '3', 'product_sort_by', 'SORT BY:', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1812', '29', '3', 'webtext_euro_symbol', '€ ', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1813', '29', '3', 'registerPageWrongLoginTxt', 'Wrong email or password', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1814', '29', '3', 'registerPageEnterTxt', 'Sign In', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1815', '29', '3', 'signinIntroText', '<h3>Iam already a customer</h3>Have you been at The Dream Blouses before? Fill in your email address and password and we will retrieve your registered data.', 'shopping bag sign in / register page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1816', '29', '3', 'registerPageEmailAddressTxt', 'Email address:', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1817', '29', '3', 'registerPagePasswordTxt', 'Password:', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1818', '29', '3', 'registerPageSignInBtnTxt', 'SIGN IN', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1819', '29', '3', 'registerPageRegisterTxt', 'Register', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1820', '29', '3', 'registerIntroText', '<h3>Not a customer yet?</h3>Is this your first time here? We will ask you for some data in order to make your shopping as easy and safe as possible.', 'shopping bag sign in / register page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1821', '29', '3', 'registerPageUserTitleTxt', 'Title:', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1822', '29', '3', 'registerPageUserTitleMrTxt', 'Mr.', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1823', '29', '3', 'registerPageUserTitleMrsTxt', 'Mrs.', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1824', '29', '3', 'registerPageFirstNameTxt', 'First Name:', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1825', '29', '3', 'registerPageLastNameTxt', 'Last Name:', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1826', '29', '3', 'registerPageStreetTxt', 'Street / nr.:', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1827', '29', '3', 'registerPageZipCodeTxt', 'Zip code:', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1828', '29', '3', 'registerPageZipCodeExampleTxt', '(i.e. 3354VL)', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1829', '29', '3', 'registerPageCityTxt', 'City:', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1830', '29', '3', 'registerPageCountryTxt', 'Country:', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1831', '29', '3', 'registerPageBirthdateTxt', 'Birthdate:', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1832', '29', '3', 'registerPagePhoneNumberTxt', 'Phone number:', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1833', '29', '3', 'registerPageSubscribeTxt', 'Subscribe to our newsletters', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1834', '29', '3', 'registerPageRegisterBtnTxt', 'REGISTER', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1835', '29', '3', 'RequiredCheckboxMultipleSelect', 'Ви повинні вибрати варіант', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1836', '29', '3', 'RequiredCheckboxSelect', 'Необхідно відмітити', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1837', '29', '3', 'EqualsAlertText', 'Невірне підтвердження паролю', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1838', '29', '3', 'RequiredBetween', 'Повинно бути від', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1839', '29', '3', 'RequiredTo', 'до', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1840', '29', '3', 'RequiredSymbols', 'символів', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1841', '29', '3', 'RequiredChecksAllowedExceeded', 'Неможливо вибрати стільки варіантів', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1842', '29', '3', 'RequiredPleaseSelect', 'Будь ласка, виберіть', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1843', '29', '3', 'RequiredOptions', 'опції', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1844', '29', '3', 'RequiredFieldsIsNotMatching', 'Значення не співпадають', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1845', '29', '3', 'RequiredInvalidDateFormat', 'Неправильна дата, повинна бути у ГГГГ-MM-ДД форматі', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1846', '29', '3', 'RequiredNumbersOnly', 'Тільки числа', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1847', '29', '3', 'RequiredNoSpecialCaracters', 'Заборонені спеціальні символи', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1848', '29', '3', 'RequiredUserIsAvailable', 'Даний користувач доступний', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1849', '29', '3', 'RequiredLoading', 'Завантаження, чекайте', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1850', '29', '3', 'RequiredUserIsAlreadyTaken', 'Даний користувач вже зайнятий', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1851', '29', '3', 'RequiredNameIsAlreadyTaken', 'Це ім`я вже зайняте', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1852', '29', '3', 'RequiredNameIsAvailable', 'Це ім`я вільне', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1853', '29', '3', 'RequiredEmailIsAlreadyTaken', 'Даний email вже зайнятий', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1854', '29', '3', 'RequiredEmailIsAvailable', 'Даний email вільний', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1855', '29', '3', 'RequiredLettersOnly', 'Тільки літери', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1856', '29', '3', 'RequiredFirstnameLastname', 'Ви повинні заповнити поля з іменем та прізвищем', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1857', '29', '3', 'ValidationContactFormPhoneNumberFormat', 'Невірний формат телефону', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1858', '29', '3', 'ValidationContactFormURLFormat', 'Невірний формат URL', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1859', '29', '3', 'user-logout', 'Logout', 'Sign In object', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1860', '29', '3', 'user-welcome', 'Wellcome, ', 'Sign In object', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1861', '29', '3', 'user-profile-menu-title', 'Profile information', 'Sign In object', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1862', '29', '3', 'user-orders-list-menu-title', 'Orders list', 'Sign In object', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1863', '29', '3', 'out_of_stock', 'OUT OF STOCK', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1864', '29', '3', 'product_made', 'Manufactured by:', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1865', '29', '3', 'product_model', 'Model:', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1866', '29', '3', 'product_size', 'Size:', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1867', '29', '3', 'choose_size', 'Choose size', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1868', '29', '3', 'size_table', 'Size table', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1869', '29', '3', 'product_size_table', 'Size table', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1870', '29', '3', 'product_color', 'Color:', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1871', '29', '3', 'product-quantity', 'Quantity:', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1872', '29', '3', 'add_to_cart', 'ADD TO CART', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1873', '29', '3', 'basketTableItemDescription', 'Item description', 'Shopping bag page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1874', '29', '3', 'basketTableSize', 'Size', 'Shopping bag page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1875', '29', '3', 'basketTableStatus', 'Status', 'Shopping bag page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1876', '29', '3', 'basketTablePrice', 'Price', 'Shopping bag page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1877', '29', '3', 'basketTableQTY', 'QTY', 'Shopping bag page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1878', '29', '3', 'basketTableDelete', 'Delete', 'Shopping bag page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1879', '29', '3', 'basketTableTotal', 'Total', 'Shopping bag page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1880', '29', '3', 'basketTableInStock', 'In stock', 'Shopping bag page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1881', '29', '3', 'basketItemRemoveTitle', 'Remove', 'Shopping bag page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1882', '29', '3', 'basketSubTotalLabel', 'Sub-total (incl. BTW):', 'Shopping bag page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1883', '29', '3', 'basketDeliveryLabel', 'Delivery:', 'Shopping bag page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1884', '29', '3', 'basketPromotionalLabel', 'Promotional code:', 'Shopping bag page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1885', '29', '3', 'basketTotalLabel', 'Total (incl. BTW):', 'Shopping bag page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1886', '29', '3', 'basketProceedToCheckoutButton', 'PROCEED TO CHECKOUT', 'Shopping bag page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1887', '29', '3', 'basketContinueShoppingButton', 'Continue shopping', 'Shopping bag page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1888', '29', '3', 'BillingAddressTitle', 'Billing address', 'Billing / Shipping page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1889', '29', '3', 'BillingAddressIntro', 'When you are new can create your account here. Enter your details below', 'Billing / Shipping page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1890', '29', '3', 'ShippingAddressTitle', 'Shipping address', 'Billing / Shipping page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1891', '29', '3', 'ShippingAddressEqBilling', 'Shipping address is the same as my billing address.', 'Billing / Shipping page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1892', '29', '3', 'ShippingAddressDifferentBilling', 'Deliver my order to a different address.', 'Billing / Shipping page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1893', '29', '3', 'ShoppingBagProceedToOverview', 'PROCEED TO OVERVIEW', 'Shipping / Billing page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1894', '29', '3', 'basketTableOutStock', 'Out stock', 'Shopping bag page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1895', '29', '3', 'paymentMethodsTitle', 'Choose payment method', 'Order overview page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1896', '29', '3', 'paymentMethodsLabel', 'Choose one of the payment methods below.', 'Order overview page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1897', '29', '3', 'basketSubmitOrderButton', 'SUBMIT ORDER', 'Order overview page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1898', '29', '3', 'SELECT_EXPORT_FORMAT', 'Select export format', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1899', '29', '3', 'task_param_export_format_xls', 'Excel5', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1900', '29', '3', 'task_name_xls', 'XLS', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1901', '29', '3', 'task_param_export_format_csv', 'CSV', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1902', '29', '3', 'task_name_csv', 'CSV', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1903', '29', '3', 'mail_cron_finished_error', 'Error', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1904', '29', '3', 'users_export_excel_success', 'Process was successfully completed', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1905', '29', '3', 'users_export_excel_error', 'Process exited with an error', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1906', '29', '3', 'SELECT_EXPORT_TYPE_USERS', 'Select type users', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1907', '29', '3', 'task_param_export_type_registered', 'isRegistered', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1908', '29', '3', 'task_name_export_type', 'isRegistered', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1909', '29', '3', 'task_param_export_format_subscriber', 'isSubscriber', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1910', '29', '3', 'task_param_export_type_subscriber', 'isSubscriber', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1911', '29', '3', 'task_name_registered', 'isRegistered', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1912', '29', '3', 'task_name_subscriber', 'isSubscriber', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1913', '29', '3', 'task_param_export_type_register', 'active', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1914', '29', '3', 'task_name_register', 'isRegister', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1915', '29', '3', 'BE_LangCopyNextBtn', 'Продовжити', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1916', '29', '3', 'BE_LangCopyFromTitle', 'Копіювати контент з:', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1917', '29', '3', 'BE_LangCopySiteTitle', 'Сайт:', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1918', '29', '3', 'BE_LangCopyLangTitle', 'Мова:', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1919', '29', '3', 'BE_LangCopyError', 'Дану операцію не можна виконати', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1920', '29', '3', 'BE_LangCopyToTitle', 'Копіювати контент на:', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1921', '29', '3', 'BE_LangCopySettingsTitle', 'Налаштування:', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1922', '29', '3', 'BE_LangCopyCopyTitle', 'Створити контент', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1923', '29', '3', 'BE_LangCopyDeleteTitle', 'Видалити існуючий контент', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1924', '29', '3', 'done', 'SEND', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1925', '29', '3', 'passwdPageEmailAddressTxt', 'Email address:', 'Reg form page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1926', '29', '3', 'product_material', 'Material:', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1979', '29', '3', 'searchResult', 'Search results', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1980', '29', '3', 'findWide', 'found', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1981', '29', '3', 'pagesWide', 'page (pages)', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1982', '29', '3', 'NotfindWide', 'not found', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1983', '29', '3', 'email_is_registered', 'This email address is already registered.', 'Sign in page text', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1984', '29', '3', 'joinSubscribeRSSButton', 'JOIN', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1986', '29', '3', 'emailInputTxt', 'Email incorrect', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1987', '29', '3', 'confirmationBackButton', 'BACK TO HOMEPAGE', 'Confirmation page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('1989', '29', '3', 'BE_SiteCopyFromTitle', 'Створити копію сайту:', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1990', '29', '3', 'BE_CopySiteTitle', 'Сайт джерело:', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1991', '29', '3', 'BE_SiteCopyNewSiteTitle', 'Назва нового сайту:', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1992', '29', '3', 'BE_SiteCopyNewSiteURL', 'Домен (без http://):', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1993', '29', '3', 'BE_CopySiteCountry', 'Країна:', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('1994', '29', '3', 'BE_CopySiteLangs', 'Мови:', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('2035', '29', '3', 'order_status_in progress', 'Зміна статусу замовлення in progress', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('2034', '29', '3', 'order_status_paid', 'Зміна статусу замовлення paid', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('2033', '29', '3', 'order_status_canceling', 'Зміна статусу замовлення canceling', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('2032', '29', '3', 'order_status_', 'Зміна статусу замовлення ', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('2031', '29', '3', 'signinRegisterIntroText', '<h3>Iam already a customer</h3>Have you been at The Dream Blouses before? Fill in your email address and password and we will retrieve your registered data.', 'shopping bag sign in / register page', '1', '1');
INSERT INTO `fe_WebText` VALUES ('2030', '29', '3', 'applyOrderModeration', 'Apply', null, '1', '1');
INSERT INTO `fe_WebText` VALUES ('2024', '29', '3', 'Learn_more_button', 'Узнать больше', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('2029', '29', '3', 'user_new_password_event_name', 'Зміна пароля користувачем', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('2026', '29', '3', 'TEST_TASK', 'Тестовий процес', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('2027', '29', '3', 'TEST_SHOW_TASK', 'Процес показу тестового процеса', '', '1', '1');
INSERT INTO `fe_WebText` VALUES ('2028', '29', '3', 'ENTER_NUMBER_FACTORIAL', 'Введть число факторіала:', '', '1', '1');

-- ----------------------------
-- Table structure for `tbl_Menu_Roles`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_Menu_Roles`;
CREATE TABLE `tbl_Menu_Roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roleId` int(11) NOT NULL,
  `menuId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `roleKey` (`roleId`),
  CONSTRAINT `roleKey` FOREIGN KEY (`roleId`) REFERENCES `tbl_Roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=733 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_Menu_Roles
-- ----------------------------
INSERT INTO `tbl_Menu_Roles` VALUES ('671', '9', '1');
INSERT INTO `tbl_Menu_Roles` VALUES ('672', '9', '7');
INSERT INTO `tbl_Menu_Roles` VALUES ('673', '9', '8');
INSERT INTO `tbl_Menu_Roles` VALUES ('674', '9', '9');
INSERT INTO `tbl_Menu_Roles` VALUES ('675', '9', '10');
INSERT INTO `tbl_Menu_Roles` VALUES ('676', '9', '11');
INSERT INTO `tbl_Menu_Roles` VALUES ('677', '9', '12');
INSERT INTO `tbl_Menu_Roles` VALUES ('678', '9', '13');
INSERT INTO `tbl_Menu_Roles` VALUES ('679', '9', '36');
INSERT INTO `tbl_Menu_Roles` VALUES ('680', '9', '2');
INSERT INTO `tbl_Menu_Roles` VALUES ('681', '9', '15');
INSERT INTO `tbl_Menu_Roles` VALUES ('682', '9', '16');
INSERT INTO `tbl_Menu_Roles` VALUES ('683', '9', '20');
INSERT INTO `tbl_Menu_Roles` VALUES ('684', '9', '38');
INSERT INTO `tbl_Menu_Roles` VALUES ('685', '9', '4');
INSERT INTO `tbl_Menu_Roles` VALUES ('686', '9', '5');
INSERT INTO `tbl_Menu_Roles` VALUES ('687', '9', '17');
INSERT INTO `tbl_Menu_Roles` VALUES ('688', '9', '18');
INSERT INTO `tbl_Menu_Roles` VALUES ('689', '9', '19');
INSERT INTO `tbl_Menu_Roles` VALUES ('690', '9', '25');
INSERT INTO `tbl_Menu_Roles` VALUES ('691', '9', '26');
INSERT INTO `tbl_Menu_Roles` VALUES ('692', '9', '27');
INSERT INTO `tbl_Menu_Roles` VALUES ('693', '9', '28');
INSERT INTO `tbl_Menu_Roles` VALUES ('694', '9', '29');
INSERT INTO `tbl_Menu_Roles` VALUES ('695', '9', '32');
INSERT INTO `tbl_Menu_Roles` VALUES ('696', '9', '35');
INSERT INTO `tbl_Menu_Roles` VALUES ('697', '9', '37');
INSERT INTO `tbl_Menu_Roles` VALUES ('698', '9', '14');
INSERT INTO `tbl_Menu_Roles` VALUES ('716', '10', '1');
INSERT INTO `tbl_Menu_Roles` VALUES ('717', '10', '7');
INSERT INTO `tbl_Menu_Roles` VALUES ('718', '10', '8');
INSERT INTO `tbl_Menu_Roles` VALUES ('719', '10', '9');
INSERT INTO `tbl_Menu_Roles` VALUES ('720', '10', '10');
INSERT INTO `tbl_Menu_Roles` VALUES ('721', '10', '11');
INSERT INTO `tbl_Menu_Roles` VALUES ('722', '10', '12');
INSERT INTO `tbl_Menu_Roles` VALUES ('723', '10', '13');
INSERT INTO `tbl_Menu_Roles` VALUES ('724', '10', '2');
INSERT INTO `tbl_Menu_Roles` VALUES ('725', '10', '15');
INSERT INTO `tbl_Menu_Roles` VALUES ('726', '10', '16');
INSERT INTO `tbl_Menu_Roles` VALUES ('727', '10', '20');
INSERT INTO `tbl_Menu_Roles` VALUES ('728', '10', '4');
INSERT INTO `tbl_Menu_Roles` VALUES ('729', '10', '5');
INSERT INTO `tbl_Menu_Roles` VALUES ('730', '10', '17');
INSERT INTO `tbl_Menu_Roles` VALUES ('731', '10', '19');
INSERT INTO `tbl_Menu_Roles` VALUES ('732', '10', '14');

-- ----------------------------
-- Table structure for `tbl_Roles`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_Roles`;
CREATE TABLE `tbl_Roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `viewId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_Roles
-- ----------------------------
INSERT INTO `tbl_Roles` VALUES ('9', 'SuperAdmin', '120');
INSERT INTO `tbl_Roles` VALUES ('10', 'Site admin', '120');

-- ----------------------------
-- Table structure for `tbl_Tasks`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_Tasks`;
CREATE TABLE `tbl_Tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `moduleName` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `startDate` varchar(255) DEFAULT NULL,
  `finishDate` varchar(255) DEFAULT NULL,
  `nextRunDate` varchar(255) DEFAULT NULL,
  `startParams` text,
  `resultParams` text,
  `visible` int(11) DEFAULT NULL,
  `interval` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_Tasks
-- ----------------------------
INSERT INTO `tbl_Tasks` VALUES ('32', 'Export users', 'Process showing export users', 'UsersExportFile', null, '2014-03-14 11:27', '2014-03-14 11:27', null, 'a:1:{s:13:\"export_fields\";a:5:{s:4:\"type\";s:13:\"export_fields\";s:3:\"ext\";s:0:\"\";s:4:\"text\";s:20:\"Select export fields\";s:13:\"export_format\";s:20:\"Select export format\";s:17:\"export_type_users\";s:17:\"Select type users\";}}', 'a:10:{i:0;a:1:{s:5:\"email\";s:16:\"rjhdsy@gmail.com\";}i:1;a:1:{s:5:\"email\";s:17:\"rjh.dsy@gmail.com\";}i:2;a:1:{s:5:\"email\";s:26:\"m.melnichuk@iproaction.com\";}i:3;a:1:{s:5:\"email\";s:22:\"maxisfighter@gmail.com\";}i:4;a:1:{s:5:\"email\";s:14:\"motkor@ukr.net\";}i:5;a:1:{s:5:\"email\";s:12:\"kvoi@ukr.net\";}i:6;a:1:{s:5:\"email\";s:23:\"s.kondratovec@gmail.com\";}i:7;a:1:{s:5:\"email\";s:23:\"geniaderkach@rambler.ru\";}i:8;a:1:{s:5:\"email\";s:22:\"geniaderkach@gmail.com\";}i:9;a:1:{s:5:\"email\";s:16:\"korvin00@ukr.net\";}}', '1', null);
INSERT INTO `tbl_Tasks` VALUES ('33', 'Тестовий процес', 'Процес показу тестового процеса', 'TaskTest', null, null, null, null, 'a:1:{s:5:\"input\";a:3:{s:4:\"type\";s:5:\"input\";s:3:\"ext\";s:0:\"\";s:4:\"text\";s:45:\"Введть число факторіала:\";}}', null, '1', null);

-- ----------------------------
-- Table structure for `tbl_Website_Admin`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_Website_Admin`;
CREATE TABLE `tbl_Website_Admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `adminId` int(10) NOT NULL,
  `websiteId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Website_Admin` (`websiteId`),
  CONSTRAINT `fk_Website_Admin` FOREIGN KEY (`websiteId`) REFERENCES `be_WebSites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=521 DEFAULT CHARSET=cp1251 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of tbl_Website_Admin
-- ----------------------------
INSERT INTO `tbl_Website_Admin` VALUES ('520', '1', '1');
