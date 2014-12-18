<?php

class Product {
    private static $instance = array();
    protected $id;
    protected $db;
    protected $langId;
    public $data = array();
    public $photos = array();

    public static function getInstance($id)
    {
        if (!isset(self::$instance[$id]))
        {
            self::$instance[$id] = new self($id);
        }

        return self::$instance[$id];
    }

    private function __construct($id)
    {
        $this->id = (int)$id;
        $this->db = Context::DB();
        $this->langId = Context::LanguageId();
        $this->loadData();
        $this->loadPhotos();

    }

    protected function loadData()
    {
        $query = "  SELECT
                      p.id,
                      p.codeName,
                      p.categoryId,
                      p.price,
                      p.oldPrice,
                      p.itemNumber,
                      p.visible,
                      t.title title,
                      t.shortDescription,
                      v.id variationId,
                      v.stock,
                      a1t.title size,
                      a2t.title color
                    FROM
                      fe_Products p
                      INNER JOIN fe_ProductTranslations t
                        ON t.productId = p.id
                        AND t.langId = {$this->langId}
                      INNER JOIN fe_ProductVariations v
                        ON v.productId = p.id
                      LEFT JOIN fe_ProductAttributeItemTranslations a1t
                        ON a1t.attributeItemId = v.attribute1ValueId
                        AND a1t.langId = {$this->langId}
                      LEFT JOIN fe_ProductAttributeItemTranslations a2t
                        ON a2t.attributeItemId = v.attribute2ValueId
                        AND a2t.langId = {$this->langId}
                    WHERE p.id = {$this->id}";

        if ($this->db->query($query))
        {
            $product = $this->db->result;

            foreach ($product as $item)
            {
                $this->data[$item['variationId']] = $item;
            }
            return true;
        }
        return false;
    }

    public function loadPhotos()
    {
        $query = "SELECT imageSmall, image
                  FROM fe_ProductImages
                  WHERE productId = {$this->id}
                  ORDER BY orderNr";

        if (!Context::DB()->query($query))
            return false;

        $result = Context::DB()->result;
        $photos = array();
        for ($i = 0;$i<count($result);$i++)
        {
            $photos[$i]['image'] = appUrl::checkUrl($result[$i]['image']);
            $photos[$i]['imageSmall'] = appUrl::checkUrl($result[$i]['imageSmall']);
        }

        $this->photos = $photos;
        return true;
    }

    public function getVariationById($id)
    {
        return isset($this->data[$id]) ? $this->data[$id] : array();
    }

    public static function getStock($variationIds)
    {
        $ids = join(',', $variationIds);

        $query = "  SELECT stock
                    FROM fe_ProductVariations
                    WHERE id IN ({$ids})";
        if(Context::DB()->query($query))
        {
            return Context::DB()->result;
        }

        return false;
    }


}