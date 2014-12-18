-- для системы с одним языком перегоняем все поля в скрытые
update 
   be_Fields
set
   displayName='',
   fieldType=1,
   rTableName='',
   rFieldName='',
   rDisplayFields='',
   displayType=0,
   visible=0,
   defaultValue=2,
   required=0,
   visibleInSearchResult=0
where
   fieldName='langId';

-- для выпадающего списка в форме поиска
update 
   be_Fields
set
   displayName='Мова',
   fieldType=30,
   rTableName='be_Languages',
   rFieldName='id',
   rDisplayFields='be_Languages.code langCode',
   displayType=1,
   visible=1,
   defaultValue=2,
   required=1,
   visibleInSearchResult=1
where
   fieldName='langId' AND viewId IN (SELECT viewId FROM be_View WHERE viewType=4);

-- для обычных и системных страниц
update 
   be_Fields
set
   displayName='Мова',
   fieldType=13,
   rTableName='',
   rFieldName='',
   rDisplayFields='',
   rSearchViewId='1',
   displayType=1,
   visible=1,
   defaultValue='',
   required=1,
   visibleInSearchResult=0
where
   fieldName='langId' AND viewId IN (SELECT viewId FROM be_View WHERE viewType=1 OR viewType=2);

-- для объектов
update 
   be_Fields
set
   displayName='Мова',
   fieldType=13,
   rTableName='',
   rFieldName='',
   rDisplayFields='',
   rSearchViewId='2',
   displayType=1,
   visible=1,
   defaultValue='',
   required=1,
   visibleInSearchResult=0
where
   fieldName='langId' AND viewId IN (SELECT viewId FROM be_View WHERE viewType=3 OR viewType=8);

-- для продуктов
update 
   be_Fields
set
   displayName='Мова',
   fieldType=13,
   rTableName='',
   rFieldName='',
   rDisplayFields='',
   rSearchViewId='46',
   displayType=1,
   visible=1,
   defaultValue='',
   required=1,
   visibleInSearchResult=0
where
   fieldName='langId' AND viewId IN (SELECT viewId FROM be_View WHERE viewType=10);

-- Для шаблонов
update 
   be_Fields
set
   displayName='Мова',
   fieldType=13,
   rTableName='',
   rFieldName='',
   rDisplayFields='',
   rSearchViewId='5',
   displayType=1,
   visible=1,
   defaultValue='',
   required=1,
   visibleInSearchResult=0
where
   fieldName='langId' AND viewId IN (SELECT viewId FROM be_View WHERE viewType=7);



ALTER TABLE fe_MasterPages CHANGE masterPageName title char(50);
UPDATE be_Fields SET fieldName = REPLACE(fieldName,'masterPageName','title') WHERE fieldName='masterPageName';
UPDATE be_Fields SET rDisplayFields = REPLACE(rDisplayFields,'masterPageName','title') WHERE rDisplayFields like('%masterPageName%');


INSERT INTO `be_AdminLanguage` VALUES ('',1,'LANGUAGE_LISTS','Доступні мови');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'PAGE_CODE_ALERT_TEXT','Ви намагаэтеся змінити код сторінки, який вже міг бути проіндексований пошуковими системами. В такому випадку, зміна коду призведе до отримання користувачем 404-ї сторінки');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'ATTENTION','Увага!');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'RELATIONS','Звязки');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'RELATED_CONTENT','Повязаний контент на інших мовах');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'ADD_RELATED_CONTENT','Створити контент');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'COPY_LANGUAGE_CONTENT','Копіювання контенту');
INSERT INTO `be_AdminLanguage` VALUES ('',2,'COPY_LANGUAGE_CONTENT','Копирование контента');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'SEARCH_RELATED_CONTENT','Знайти контент');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'LANG','Мова');
INSERT INTO `be_AdminLanguage` VALUES ('',2,'LANG','Язык');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'FOUND_PAGE_NOT_MERGABLE','Обрана сторінка вже має звязок із контентом на мові, яку Ви обрали. ');
INSERT INTO `be_AdminLanguage` VALUES ('',2,'FOUND_PAGE_NOT_MERGABLE','Выбранная страница уже имеет связь с контеном на языке, который Вы выбрали.');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'PAGES_ARE_NOT_MERGABLE','Обрана сторінка не може бути додана до звязку. Сторінка, яку Ви редагуєете вже має звязок із сторінкою на обраній мові.');
INSERT INTO `be_AdminLanguage` VALUES ('',2,'PAGES_ARE_NOT_MERGABLE','Выбранная страница не может быть добавлена к связи. СТраница, которвую Вы редактируете уже имеет связь с страницей на выбранном языке.');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'SAVE_EDITED_CONTENT','Зберегти зміни на поточній сторінці і перейти до редагування повязаної сторінки?');
INSERT INTO `be_AdminLanguage` VALUES ('',2,'SAVE_EDITED_CONTENT','Сохранить изменения на текущей странице и перейти к редактированию связанной страницы?');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'DELETE_PAGE_RELATION','Ви дійсно бажаєте видалити звязок з цим контентом?');
INSERT INTO `be_AdminLanguage` VALUES ('',2,'DELETE_PAGE_RELATION','Удалить связь с этим контентом?');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'COPY_CONTENT_TO_NEXT_LANGS','Створити повязаний контент на наступних мовах:');
INSERT INTO `be_AdminLanguage` VALUES ('',2,'COPY_CONTENT_TO_NEXT_LANGS','Создать связанный контент на следующих языках:');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'NEXT_LANG_CONTENT_ADD','Увага!<br/>Збережені дані будуть використані при створенні повязаного контенту для наступної мови.');
INSERT INTO `be_AdminLanguage` VALUES ('',2,'NEXT_LANG_CONTENT_ADD','Внимание!<br/> Сохраненные данные будут использованы при создании связанного контента для следующего языка.');