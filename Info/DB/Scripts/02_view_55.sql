set @viewId=55;
DELETE FROM be_View WHERE viewId=@viewId;
INSERT INTO be_View (viewId, name, tblName, className, viewType, masterPageId, active, deleteAllow, copyAllow)
VALUES(@viewId, 'Налаштування сайту', 'be_WebSites', '', '9', '0', '0', '0', '1');
DELETE FROM be_Fields WHERE viewId=@viewId;
DELETE FROM be_WhereParam WHERE viewId=@viewId;
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'viewId', 'тип відображення', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '2', '0', '55', null, '40', '0', null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'name', 'Назва', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '3', '1', null, null, '50', '0', null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'URL', 'Домен
(без http://)', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '50', '0', null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'useCache', 'Увімкнути кеш', '6', null, null, null, null, null, null, '0', '1', '0', '0', '1', '9', '1', '0', null, null, null, null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'useSMTP', 'Використовувати SMTP', '6', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', '0', null, null, null, null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'SMTPServer', 'SMTP сервер', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '50', '0', null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'SMTPUser', 'SMTP логін', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '4', '1', null, null, '50', '0', null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'SMTPPassword', 'SMTP пароль', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '5', '1', null, null, '50', '0', null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'defaultAvatarImage', 'Аватар за замовчуванням', '7', null, null, null, null, null, null, '0', '1', '0', '0', '3', '1', '1', null, null, '92', null, null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'id', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', null, null, '5', '0', null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'multiLanguage', 'Увімкнути мультимовність', '6', null, null, null, null, null, null, '0', '1', '0', '0', '4', '1', '1', '1', null, null, null, null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'id', 'Мови сайту', '33', 'be_WebsiteLanguages', 'websiteId', 'id', null, null, null, '56', '1', '1', '0', '4', '1', '1', null, '100', '670', '200', '0', '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'email', 'email сайту за замовчуванням (from)', '1', null, null, null, null, null, null, '0', '1', '1', '0', '2', '1', '1', null, null, '50', '0', null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'dateFormat', 'Формат дати 
(d - день місяця
dd - день місяця (дві цифри)
m - місяць року
mm - місяць року (дві цифри)
y - рік (дві цифри)
yy - рік (чотири цифри))', '1', null, null, null, null, null, null, '0', '1', '1', '0', '3', '4', '1', 'dd.mm.yy', null, '50', '0', null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'useSMTPAuth', 'SMTP авторизація', '6', null, null, null, null, null, null, '0', '1', '0', '0', '2', '6', '1', null, null, null, null, '0', '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'SMTPPort', 'SMTP порт', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '5', '1', null, null, '50', null, '0', '0', '0');
DELETE FROM be_Group WHERE viewId=@viewId;
INSERT INTO be_Group (viewId, groupId, groupName, groupType)
VALUES(@viewId, '1', 'Загальні', '0');
INSERT INTO be_Group (viewId, groupId, groupName, groupType)
VALUES(@viewId, '2', 'Налаштування пошти', '0');
INSERT INTO be_Group (viewId, groupId, groupName, groupType)
VALUES(@viewId, '3', 'Додаткові', '0');
INSERT INTO be_Group (viewId, groupId, groupName, groupType)
VALUES(@viewId, '4', 'Мови сайта', '0');