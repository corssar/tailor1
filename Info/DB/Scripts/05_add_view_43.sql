SET FOREIGN_KEY_CHECKS=0;
set @viewId=43;
DELETE FROM be_View WHERE viewId=@viewId;
INSERT INTO be_View (viewId, name, tblName, className, viewType, masterPageId, active, deleteAllow, copyAllow, addItemViewId, editAllow, canApply, autoSearch)
VALUES(@viewId, 'Сторінка категорій', 'fe_Pages', 'categories.php', '1', '1', '1', '1', '1', '', '1', '1', '1');
DELETE FROM be_Fields WHERE viewId=@viewId;
DELETE FROM be_WhereParam WHERE viewId=@viewId;
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, className, phpCode, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'title', 'Назва сторінки', '1', null, null, null, null, null, null, '0', '1', '1', '0', '1', '4', '1', null, null, '40', '0', null, null, null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, className, phpCode, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'seo2', 'Ключові слова', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '3', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, className, phpCode, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'seo1', 'Опис сторінки', '2', null, null, null, null, null, null, '0', '1', '0', '0', '2', '2', '1', null, null, '40', '10', null, null, null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, className, phpCode, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'codeName', 'Код сторінки', '43', null, null, null, null, null, null, '0', '1', '1', '0', '1', '5', '1', null, null, '86', '0', null, null, null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, className, phpCode, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'html', 'Контент сторінки (HTML)', '3', null, null, null, null, null, null, '0', '1', '1', '0', '3', '1', '1', null, null, '650', '470', null, null, null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, className, phpCode, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'viewId', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '1', '0', @viewId, null, null, null, null, null, null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, className, phpCode, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'id', null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '1', '2', '0', null, null, '5', '0', null, null, null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, className, phpCode, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'masterPageId', 'Майстер шаблону', '30', 'fe_MasterPages', 'id', null, null, null, 'fe_MasterPages.title title', '0', '1', '0', '0', '1', '6', '1', null, null, '265', null, null, null, null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, className, phpCode, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'langId', 'Мова', '13', null, null, null, null, null, null, '1', '1', '1', '0', '1', '3', '1', null, null, '100', '0', null, null, null, '0', '0');
INSERT INTO be_Fields (viewId, fieldName, displayName, fieldType, rTableName, rFieldName, rSourcePointerField, rSourceTableName, rSourceLinkField, rDisplayFields, rSearchViewId, displayType, required, validation, groupId, orderNumber, visible, defaultValue, availableValues, width, height, className, phpCode, searchType, participantSearch, visibleInSearchResult)
VALUES(@viewId, 'seoTitle', 'SEO Title', '1', null, null, null, null, null, null, '0', '1', '0', '0', '2', '1', '1', null, null, '92', null, null, null, '0', '0', '0');
DELETE FROM be_Group WHERE viewId=@viewId;
INSERT INTO be_Group (viewId, groupId, groupName)
VALUES(@viewId, '1', 'Системна інформація');
INSERT INTO be_Group (viewId, groupId, groupName)
VALUES(@viewId, '2', 'Мета-теги');
INSERT INTO be_Group (viewId, groupId, groupName)
VALUES(@viewId, '3', 'Детальний опис');
SET FOREIGN_KEY_CHECKS=1;