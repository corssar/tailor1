-- ��� ������� � ����� ������ ���������� ��� ���� � �������
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

-- ��� ����������� ������ � ����� ������
update 
   be_Fields
set
   displayName='����',
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

-- ��� ������� � ��������� �������
update 
   be_Fields
set
   displayName='����',
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

-- ��� ��������
update 
   be_Fields
set
   displayName='����',
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

-- ��� ���������
update 
   be_Fields
set
   displayName='����',
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

-- ��� ��������
update 
   be_Fields
set
   displayName='����',
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


INSERT INTO `be_AdminLanguage` VALUES ('',1,'LANGUAGE_LISTS','������� ����');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'PAGE_CODE_ALERT_TEXT','�� ����������� ������ ��� �������, ���� ��� �� ���� �������������� ���������� ���������. � ������ �������, ���� ���� �������� �� ��������� ������������ 404-� �������');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'ATTENTION','�����!');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'RELATIONS','������');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'RELATED_CONTENT','��������� ������� �� ����� �����');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'ADD_RELATED_CONTENT','�������� �������');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'COPY_LANGUAGE_CONTENT','��������� ��������');
INSERT INTO `be_AdminLanguage` VALUES ('',2,'COPY_LANGUAGE_CONTENT','����������� ��������');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'SEARCH_RELATED_CONTENT','������ �������');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'LANG','����');
INSERT INTO `be_AdminLanguage` VALUES ('',2,'LANG','����');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'FOUND_PAGE_NOT_MERGABLE','������ ������� ��� �� ������ �� ��������� �� ���, ��� �� ������. ');
INSERT INTO `be_AdminLanguage` VALUES ('',2,'FOUND_PAGE_NOT_MERGABLE','��������� �������� ��� ����� ����� � �������� �� �����, ������� �� �������.');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'PAGES_ARE_NOT_MERGABLE','������ ������� �� ���� ���� ������ �� ������. �������, ��� �� ��������� ��� �� ������ �� �������� �� ������ ���.');
INSERT INTO `be_AdminLanguage` VALUES ('',2,'PAGES_ARE_NOT_MERGABLE','��������� �������� �� ����� ���� ��������� � �����. ��������, �������� �� ������������ ��� ����� ����� � ��������� �� ��������� �����.');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'SAVE_EDITED_CONTENT','�������� ���� �� ������� ������� � ������� �� ����������� �������� �������?');
INSERT INTO `be_AdminLanguage` VALUES ('',2,'SAVE_EDITED_CONTENT','��������� ��������� �� ������� �������� � ������� � �������������� ��������� ��������?');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'DELETE_PAGE_RELATION','�� ����� ������ �������� ������ � ��� ���������?');
INSERT INTO `be_AdminLanguage` VALUES ('',2,'DELETE_PAGE_RELATION','������� ����� � ���� ���������?');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'COPY_CONTENT_TO_NEXT_LANGS','�������� ��������� ������� �� ��������� �����:');
INSERT INTO `be_AdminLanguage` VALUES ('',2,'COPY_CONTENT_TO_NEXT_LANGS','������� ��������� ������� �� ��������� ������:');
INSERT INTO `be_AdminLanguage` VALUES ('',1,'NEXT_LANG_CONTENT_ADD','�����!<br/>�������� ��� ������ ���������� ��� �������� ���������� �������� ��� �������� ����.');
INSERT INTO `be_AdminLanguage` VALUES ('',2,'NEXT_LANG_CONTENT_ADD','��������!<br/> ����������� ������ ����� ������������ ��� �������� ���������� �������� ��� ���������� �����.');