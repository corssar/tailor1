<?php
require_once(FRAMEWORK_PATH."core/PageObject.php");
require_once(FRAMEWORK_PATH."custom/partners.php");

class PartnersBannerObject extends PageObject
{
    const PARTNERS_ON_PAGE = 6;

    /**
     * Возвращает случайный ид партнера
     *
     * @param $rand случайное число
     * @param $arr  масив с данными партнеров
     * @return int|string   ид партнера
     */
    private function genPartner($rand, $arr)
    {
        $line = 0;
        foreach ($arr as $key => $value){
            $line = $line + $value['freq'];
            if ($rand <= $line) {
                return $key;
            }
        }
    }

    /**
     * Возвращает масив данных случайных партнеров
     * в количестве  PARTNERS_ON_PAGE
     * частота выпадания партнера зависит от параметра freq,
     * который задается в админке
     *
     * @param $partners
     * @return array    масив с случайными не пересекающимися
     *                  ид партнеров
     */
    private function getHomePartners($partners)
    {
        $partners_freq = array();

        $dis = array();
        $test = $partners;

        for ($j=1; $j<=self::PARTNERS_ON_PAGE; $j++){
            $sum = 0;
            foreach ($test as $value){
                $sum = $sum + $value['freq'];
            }

            $rand = mt_rand(0, $sum);

            $id = $this->genPartner($rand, $test);
            $partners_freq[$id] = $partners_freq[$id]+1;
            $dis[$j] = $partners[$id];
            unset($test[$id]);
        }

        return $dis;
    }

    public function loadPageObject()
    {
        $poData = new PageObjectData($this->poId);
        if($poData->load())
        {
            $partners = new Partners();

            // отримуємо з кешу чи з бази данних список з данними всіх партнерів
            $cache = new CacheFace();
            if( $cachedata = $cache->get('partnersListObject_'.$this->poId)){
                $partnersList = unserialize($cachedata);
            }else{
                $partnersList = $partners->getList();
                $cache->save(serialize($partnersList));
            }


            // сгенерировать 6 случайных партнеров и передать их в шаблон
            $this->pageObjectData['partnersList'] = $this->getHomePartners($partnersList);
            $this->setTemplate('templates/PageObjects/partnersBannerObject.tpl');
        }
        else
        {//no data for PO
            return false;
        }
        return true;
    }
}
?>