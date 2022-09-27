<?php
/**
 * the first club
 * 
 * @link    http://www.thefirstclub.com
 * @package app_module_content_model
 */

/**
 * @category app
 * @package app_module_content_model
 */
                        

class Module_Content_Model extends Core_Model
{
    
    /**
     * Salesforce connection
     * 
     * @var object
     */
    public $salesforce = null;
    
    /**
     * Site content types
     * Format: content name => content type id
     * 
     * @var array
     */
    public $content = array(
        'music'      => 1,
        'games'      => 2,
        'software'   => 3,
        'mobile'     => 4,
        'abooks'     => 5,
        'ebooks'     => 6,
        'movies'     => 7,
        'emagazines' => 8,
        'musictracks' => 9,
        'giftcards' => 10,
    );

    /**
     * Site content abbreviations. Used primarily for order IDs
     * Format: content type id => content abbreviation
     *
     * @var array
     */
    public $contentAbbr = array(
        1 => 'msc',
        2 => 'gms',
        3 => 'sft',
        4 => 'mob',
        5 => 'abk',
        6 => 'ebk',
        7 => 'mov',
        8 => 'emg',
        10 => 'gc',
    );
    
    /**
     * Europe countries
     * 
     * @var array
     */
    public $countriesEurope = array('AD','AL','AT','BA','BE','BG','BY','CH','CY','CZ','DK','EE','FI','FO','GG','GI','GR','HR','HU','IE','IM','IS','JE','LI','LT','LU','LV','MC','MD','MK','MT','NL','NO','PL','PT','RO','RU','SE','SI','SJ','SK','SM','TR','UA','UK','VA','YU','EU','FR','DE','GB','ES','IT', 'PT');
    
    /**
     * Special countries
     * 
     * @var array
     */
    public $countriesSpecial = array('FR', 'DE', 'GB', 'ES', 'IT', 'US', 'CA', 'EU', 'SE', 'NO', 'FI', 'DK', 'IE', 'NL', 'BE', 'CH', 'ALL');
    
    /**
     * Countries by catalog
     * 
     * @var array
     */
    public $cataloguesCountry = array(
        'software'   => array('GB'=>'GB',  'FR'=>'FR',  'ES'=>'ES',  'DE'=>'DE',  'EU'=>'EU',  'ALL'=>'EU',  'US'=>'US',  'IT'=>'IT',  'CA'=>'EU',  'SE'=>'EU',  'NO'=>'EU',  'FI'=>'EU',  'DK'=>'EU',  'IE'=>'EU',  'NL'=>'EU',  'BE'=>'EU',  'CH' => 'CH', 'AU'=>'EU', 'NZ'=>'EU', 'PT'=>'EU'),
        'games'      => array('GB'=>'GB',  'FR'=>'FR',  'ES'=>'ES',  'DE'=>'DE',  'EU'=>'EU',  'ALL'=>'EU',  'US'=>'US',  'IT'=>'IT',  'CA'=>'EU',  'SE'=>'EU',  'NO'=>'EU',  'FI'=>'EU',  'DK'=>'EU',  'IE'=>'EU',  'NL'=>'EU',  'BE'=>'EU',  'CH' => 'CH', 'AU'=>'EU', 'NZ'=>'EU', 'PT'=>'EU'),
        'music'      => array('GB'=>'GB',  'FR'=>'FR',  'ES'=>'ES',  'DE'=>'DE',  'EU'=>'EU',  'ALL'=>'ALL', 'US'=>'US',  'IT'=>'IT',  'CA'=>'CA',  'SE'=>'EU',  'NO'=>'EU',  'FI'=>'EU',  'DK'=>'DK',  'IE'=>'IE',  'NL'=>'NL',  'BE'=>'BE',  'CH' => 'CH', 'AU'=>'ALL', 'NZ'=>'ALL', 'PT'=>'ALL'),
        'musictracks'=> array('GB'=>'GB',  'FR'=>'FR',  'ES'=>'ES',  'DE'=>'DE',  'EU'=>'EU',  'ALL'=>'ALL', 'US'=>'US',  'IT'=>'IT',  'CA'=>'CA',  'SE'=>'EU',  'NO'=>'EU',  'FI'=>'EU',  'DK'=>'DK',  'IE'=>'IE',  'NL'=>'NL',  'BE'=>'BE',  'CH' => 'CH', 'AU'=>'ALL', 'NZ'=>'ALL', 'PT'=>'ALL'),
        'mobile'     => array('GB'=>'ALL', 'FR'=>'ALL', 'ES'=>'ALL', 'DE'=>'ALL', 'EU'=>'ALL', 'ALL'=>'ALL', 'US'=>'ALL', 'IT'=>'ALL', 'CA'=>'ALL', 'SE'=>'ALL', 'NO'=>'ALL', 'FI'=>'ALL', 'DK'=>'ALL', 'IE'=>'ALL', 'NL'=>'ALL', 'BE'=>'ALL',  'CH' => 'ALL', 'AU'=>'ALL', 'NZ'=>'ALL', 'PT'=>'ALL'),
        'abooks'     => array('GB'=>'GB',  'FR'=>'FR',  'ES'=>'ES',  'DE'=>'DE',  'EU'=>'EU',  'ALL'=>'ALL',  'US'=>'US',  'IT'=>'IT',  'CA'=>'CA',  'SE'=>'EU',  'NO'=>'EU',  'FI'=>'EU',  'DK'=>'EU',  'IE'=>'EU',  'NL'=>'EU',  'BE'=>'EU',  'CH' => 'CH', 'AU'=>'ALL', 'NZ'=>'ALL', 'PT'=>'EU'),
        'ebooks'     => array('GB'=>'GB',  'FR'=>'FR',  'ES'=>'ES',  'DE'=>'DE',  'EU'=>'EU',  'ALL'=>'ALL',  'US'=>'US',  'IT'=>'IT',  'CA'=>'CA',  'SE'=>'EU',  'NO'=>'EU',  'FI'=>'EU',  'DK'=>'EU',  'IE'=>'EU',  'NL'=>'EU',  'BE'=>'EU',  'CH' => 'CH', 'AU'=>'ALL', 'NZ'=>'ALL', 'PT'=>'EU'),
        'movies'     => array('GB'=>'GB',  'FR'=>'FR',  'ES'=>'ES',  'DE'=>'DE',  'EU'=>'EU',  'ALL'=>'EU',  'US'=>'US',  'IT'=>'IT',  'CA'=>'CA',  'SE'=>'EU',  'NO'=>'EU',  'FI'=>'EU',  'DK'=>'EU',  'IE'=>'EU',  'NL'=>'EU',  'BE'=>'EU',  'CH' => 'CH', 'AU'=>'EU', 'NZ'=>'EU', 'PT'=>'EU'),
        'emagazines' => array('GB'=>'GB', 'FR'=>'FR', 'ES'=>'ES', 'DE'=>'DE', 'EU'=>'EU', 'ALL'=>'ALL', 'US'=>'US', 'IT'=>'IT', 'CA'=>'CA', 'SE'=>'SE', 'NO'=>'NO', 'FI'=>'FI', 'DK'=>'DK', 'IE'=>'GB', 'NL'=>'NL', 'BE'=>'BE',  'CH' => 'CH', 'AU'=>'AU', 'NZ'=>'NZ', 'PT'=>'PT'),
        'giftcards' => array('GB'=>'GB',  'FR'=>'FR',  'ES'=>'ES',  'DE'=>'DE',  'EU'=>'EU',  'ALL'=>'EU',  'US'=>'US',  'IT'=>'IT',  'CA'=>'CA',  'SE'=>'EU',  'NO'=>'EU',  'FI'=>'EU',  'DK'=>'EU',  'IE'=>'EU',  'NL'=>'EU',  'BE'=>'EU',  'CH' => 'CH', 'AU'=>'EU', 'NZ'=>'EU', 'PT'=>'EU'),
    );
    
    /**
     * Available territories
     * Format: territory code => territory id
     * 
     * @var array
     */
    public $catalogues = array(
        'GB'  => 1,
        'DE'  => 2,
        'US'  => 3,
        'IT'  => 4,
        'FR'  => 5,
        'CA'  => 6,
        'ES'  => 7,
        'EU'  => 8,
        'SE'  => 9,
        'NO'  => 10,
        'FI'  => 11,
        'DK'  => 12,
        /* Added 2013-07-25 */
        'IE'  => 13,
        'NL'  => 14,
        'BE'  => 15,
        'CH'  => 16,
        'ALL' => 100,
        /* Added 2018-04-20 due to new Zinio Zenith API */
        'AU'  => 17,
        'NZ'  => 18,
        'PT'  => 19
    );
    
    /**
     * Available territories names
     * Format: territory code => territory name
     * 
     * @var array
     */
    public $cataloguesNames = array(
        'GB'  => 'United Kingdom',
        'DE'  => 'Germany',
        'US'  => 'USA',
        'IT'  => 'Italy',
        'FR'  => 'France',
        'CA'  => 'Canada',
        'ES'  => 'Spain',
        'EU'  => 'Europe',
        'SE'  => 'Sweden',
        'NO'  => 'Norway',
        'FI'  => 'Finland',
        'DK'  => 'Denmark',
        /* Added 2013-07-25 */
        'IE'  => 'Ireland',
        'NL'  => 'Netherlands',
        'BE'  => 'Belgium',
        'CH'  => 'Switzerland',

        'ALL' => 'International',
        /* Added 2018-04-20 due to new Zinio Zenith API */
        'AU'  => 'Australia',
        'NZ'  => 'New Zealand',
        'PT'  => 'Portugal'
    );
    
    /**
     * Available app currency
     * 
     * @var array
     */
    public $availableCurrency = array('EUR', 'GBP', 'USD', 'CAD', 'AUD');
    
    /**
     * Available currencies by country
     * 
     * @var array
     */
    public $currency = array('GB' => 'GBP', 'EN' => 'GBP', 'US' => 'USD', 'CA' => 'CAD', 'AT' => 'AUD');
    
    /**
     * Countries ids
     * 
     * @var array
     */
    public $countriesId = array('GB'=>34, 'UK'=>34, 'US'=>480, 'EN'=>34, 'DE'=>265, 'FR'=>870, 'EU'=>481, 'ES'=>827, 'ALL'=>496, 'IT'=>820, 'CA'=>1069);
    
    /**
     * Pagination frames
     * 
     * @var array
     */
    public $perPageSelect = array(50, 100, 250);
    
    /**
     * Letters used in products list
     * 
     * @var array
     */
    public $letters = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    
    /**
     * Letters divisions
     * 
     * @var array
     */
    public $lettersDivisions = array('a-e', 'f-i', 'j-m', 'n-q', 'r-u', 'v-z');
    
    /**
     * Audio books languages
     * 
     * @var array
     */
    public $abooksLanguages = array('ALL'=>'EN', 'EU'=>'EN', 'DE'=>'DE', 'ES'=>'ES', 'FR'=>'FR', 'IT'=>'IT', 'EN'=>'EN', 'US'=>'EN', 'CA'=>'EN', 'RU',
        'HI', // Hindi
        'PT', // Português
        'ZH', // Chinese
        'EL', // Greek
        'PL', // Polish
        'JA', // Japanese
        );
    
    /**
     * Default audio books language
     * 
     * @var string
     */
    public $abooksDefLang = 'EN';
    
    /**
     * Available audio books types
     * 
     * @var array
     */
    public $abooksTypes = array('mp3' => array(1, 5), 'wma' => array(2));
    
    /**
     * E-books languages
     * 
     * @var array
     */
    public $ebooksLanguages = array('ALL'=>'EN', 'EU'=>'EN', 'DE'=>'DE', 'ES'=>'ES', 'FR'=>'FR', 'IT'=>'IT', 'EN'=>'EN', 'US'=>'EN', 'CA'=>'EN', 'RU',
        'RO', // Romanian
        'AF', // Afrikaans
        'HU', // Hungarian
        'ZH', // Chinese
        'PT', // Português
        'NL', // Nederlands
        'EL', // Greek
        'PL', // Polish
        'TR', // Turkish
        'SR', // Serbian
        'LA', // Latin
        'GA', // Irish
        'UK', // Ukrainian
        'CY', // Welsh
        'HR', // Croatian
        'IN', // Indonesian
        'SV', // Swedish
        'JA', // Japanese
        'HI', // Hindi
        'DK', // Danske
        'MS', // Malay
        'BG', // Bulgarian
        'NO', // Norske
        'AR', // Arabic
        'BS', // Bosnian
        'TH', // Taai
        );
    
    /**
     * Default e-books language
     * 
     * @var string
     */
    public $ebooksDefLang = 'EN';
    public $giftcardsDefLang = 'EN';
    
    /**
     * Available e-books types
     * 
     * @var array
     */
    public $ebooksTypes = array('Adobe PDF' => array(2), 'Mobi' => array(3), 'MSReader' => array(4), 'EPub' => array(6));
    
    /**
     * emagazines languages
     * 
     * @var array
     */
    //public $emagazinesLanguages = array('ALL'=>'EN', 'EU'=>'EN', 'DE'=>'DE', 'ES'=>'ES', 'FR'=>'FR', 'IT'=>'IT', 'EN'=>'EN', 'US'=>'EN', 'CA'=>'EN', 'RU');
    public $emagazinesLanguages = array('ALL'=>'EN', 'EU'=>'EN', 'DE'=>'DE', 'ES'=>'ES', 'FR'=>'FR', 'IT'=>'IT', 'EN'=>'EN', 'US'=>'EN', 'CA'=>'EN', 'RU',
        'NL', //Nederlands
        'NO', //Norske
        'PT', //Português
        'SV', //Swedish
        'ZH', //Chinese
        'JA', //Japanese
        'KO', //Korean
        'HI', //Hindi
        'AF', //Afrikaans
        'SL' //Slovenian
        );
    
    
    /**
     * Default emagazines language
     * 
     * @var string
     */
    public $emagazinesDefLang = 'EN';

     /**
     * Territories for movies
     * @var array
     */
    public $moviesTerritories = array('GB','FR','DE','ES','IT');
    
    /**
     * Sort orders by content type
     * 
     * @var array
     */
    public $sortOrders = array(
        'abooks' => array(
            array('field' => 'abooks.title', 'direction' => 'asc', 'translation' => 'sortOrderName'),
            array('field' => 'price', 'direction' => 'asc', 'translation' => 'sortOrderPriceAsc'),
            array('field' => 'price', 'direction' => 'desc', 'translation' => 'sortOrderPriceDesc')
        ),
        'ebooks' => array(
            array('field' => 'ebooks.title', 'direction' => 'asc', 'translation' => 'sortOrderName'),
            array('field' => 'price', 'direction' => 'asc', 'translation' => 'sortOrderPriceAsc'),
            array('field' => 'price', 'direction' => 'desc', 'translation' => 'sortOrderPriceDesc')
        ),
        'games' => array(
            array('field' => 'games.title', 'direction' => 'asc', 'translation' => 'sortOrderName'),
            array('field' => 'price', 'direction' => 'asc', 'translation' => 'sortOrderPriceAsc'),
            array('field' => 'price', 'direction' => 'desc', 'translation' => 'sortOrderPriceDesc')
        ),
        'software' => array(
            array('field' => 'software.title', 'direction' => 'asc', 'translation' => 'sortOrderName'),
            array('field' => 'price', 'direction' => 'asc', 'translation' => 'sortOrderPriceAsc'),
            array('field' => 'price', 'direction' => 'desc', 'translation' => 'sortOrderPriceDesc')
        ),
        'mobile' => array(
            array('field' => 'mobile_description.title', 'direction' => 'asc', 'translation' => 'sortOrderName'),
            array('field' => 'price', 'direction' => 'asc', 'translation' => 'sortOrderPriceAsc'),
            array('field' => 'price', 'direction' => 'desc', 'translation' => 'sortOrderPriceDesc')
        ),
        'movies' => array(
            array('field' => 'movies.release_date DESC,movies.id', 'direction' => 'desc', 'translation' => 'sortOrderRecent'),
            array('field' => 'movies.title', 'direction' => 'asc', 'translation' => 'sortOrderName'),
            array('field' => 'price', 'direction' => 'asc', 'translation' => 'sortOrderPriceAsc'),
            array('field' => 'price', 'direction' => 'desc', 'translation' => 'sortOrderPriceDesc')
        ),
        'emagazines' => array(
            array('field' => 'emagazines.title', 'direction' => 'asc', 'translation' => 'sortOrderName'),
            array('field' => 'price', 'direction' => 'asc', 'translation' => 'sortOrderPriceAsc'),
            array('field' => 'price', 'direction' => 'desc', 'translation' => 'sortOrderPriceDesc')
        ),
        'giftcards' => array(
            array('field' => 'giftcards.title', 'direction' => 'asc', 'translation' => 'sortOrderName'),
            array('field' => 'price', 'direction' => 'asc', 'translation' => 'sortOrderPriceAsc'),
            array('field' => 'price', 'direction' => 'desc', 'translation' => 'sortOrderPriceDesc')
        )
    );

    public function getFilters($type, $terrId, $shopId = null){
        if($shopId == null) $shopId = self::$SHOP['id'];

        // Get applicable filters
        $filters = DB::fetchAll('
            SELECT filter_sql, auto_and
              FROM content_filters_v3
             WHERE shop_id = :shop
               AND (territory_id = :territory OR territory_id = 0)
               AND content_type = :content',
            array(
                'shop'=>$shopId,
                'territory'=>$terrId,
                'content'=>$type
            )
        );

        $final = '';
        foreach($filters as $filter){
            // if filter is empty then don't do anything
            if(strlen(trim($filter['filter_sql'])) == 0){
                continue;
            }
                    
            $start = '';
            $end = '';

            if((int)$filter['auto_and'] === 1){
                $start = ' AND (';
                $end = ')';
            }

            $final .= $start . $filter['filter_sql'] . $end;
        }
        return $final;
    }
    
    /**
     * Gets the shop level filters to be used in sphinx
     * @param string $type content type
     * @param int $terrId territory id, 0 for all
     * @param int $shopId default is null
     * @return array or null
     */
    public function getFiltersSphinx($type, $terrId, $shopId = null) {
        if ($shopId == null)
            $shopId = self::$SHOP['id'];

        // Get applicable filters
        $filters = DB::fetchRow('
            SELECT filter_sphinx_json
              FROM content_filters_v3
             WHERE shop_id = :shop
               AND (territory_id = :territory OR territory_id = 0)
               AND content_type = :content
            ORDER BY territory_id DESC', // add order by so we get the territory specific filter first if any
                        array(
                    'shop' => $shopId,
                    'territory' => $terrId,
                    'content' => $type
                        )
        );

        if (isset($filters['filter_sphinx_json']) && isset($filters['filter_sphinx_json']) != ''):
            $shopFilters = json_decode($filters['filter_sphinx_json'], true);
        else:
            $shopFilters = null;
        endif;

        return $shopFilters;
    }

    public function getSalesforce()
    {
        if($this->salesforce === null) {
            $time = time();
            $maintenance = Settings::app()->sfMaintenance;
            if ($time >= $maintenance['unavailable']['begin'] && $time < $maintenance['unavailable']['end']){
                // We're in SF maintenance mode
                if($this->request->isAjax()) {
                    $seconds = (int)$maintenance['unavailable']['end'] - $time;
                    $runTime = array();
                    $runTime['total']   = $seconds;
                    $runTime['hours']   = floor($seconds / 3600);
                    $runTime['minutes'] = floor(($seconds - ($runTime['hours']*3600)) /60);
                    $runTime['hourMins'] = $runTime['hours'].':'.sprintf("%02d", $runTime['minutes']);
                    $message = $this->TR->__('global.salesforceMaintenance', 'Some of our systems are currently down for maintenance. We expect them to return in approximately %s');
                    $this->tpl->message = sprintf($message, $runTime['hourMins']);
                    Template_Json::error($message);
                }
                Tools::go('maintenance');
            }
            $this->salesforce = Library_Loader::Load('Library_Salesforce');
            $this->salesforce->connect(Settings::app()->sfConfig['user'], Settings::app()->sfConfig['pass']);
            if(!$this->salesforce->isConnected()) {
                if($this->request->isAjax()) {
                    $message = $this->TR->__('global.technicalErrorMessage', 'We are experiencing some technical difficulties, please try again later');
                    Template_Json::error($message);
                }
                Tools::go('error');
            }
        }
        return $this->salesforce;
    }
    
    public function getContentCurrency($toLower = false)
    {
        $country = $this->DAO('model', 'users')->getUserCountry();
        if(array_key_exists($country, $this->currency)) {
            $currency = $this->currency[$country];
        } else {
            $currency = 'EUR';
        }
        return $toLower ? strtolower($currency) : $currency;
    }
    
    public function getContentCountry($content)
    {
        if(!array_key_exists($content, $this->content)) {

            return false;
        }

        $userCountry = $this->DAO('model', 'users')->getUserCountry();
        if(isset($this->cataloguesCountry[$content][$userCountry])) {
            return $this->cataloguesCountry[$content][$userCountry];

        }
        return false;
    }
    
    public function getContentCountryId($content)
    {
        return $this->getTerritoryId($this->getContentCountry($content));
    }
    
    public function getAbooksLanguage($asId = true)
    {
        $language = $this->abooksDefLang;
        $contentCountry = $this->getContentCountry('abooks');
        if(isset($this->abooksLanguages[$contentCountry])) {
            $language = $this->abooksLanguages[$contentCountry];
        }
        
        if($asId) {
            return Library_Language::getInstance()->getIdByCode($language);
        }
        return $language;
    }
    
    public function getEbooksLanguage($asId = true)
    {
        $language = $this->ebooksDefLang;
        $contentCountry = $this->getContentCountry('ebooks');
        if(isset($this->ebooksLanguages[$contentCountry])) {
            $language = $this->ebooksLanguages[$contentCountry];
        }
        
        if($asId) {
            return Library_Language::getInstance()->getIdByCode($language);
        }
        return $language;
    }

    public function getEmagazinesLanguage($asId = true)
    {
        $language = $this->emagazinesDefLang;
        $contentCountry = $this->getContentCountry('emagazines');
        if(isset($this->emagazinesLanguages[$contentCountry])) {
            $language = $this->emagazinesLanguages[$contentCountry];
        }
        
        if($asId) {
            return Library_Language::getInstance()->getIdByCode($language);
        }
        return $language;
    }
    
//    public function getGiftcardsLanguage($asId = true)
//    {
//        $language = $this->giftcardsDefLang;
//        
//        if($asId) {
//            return Library_Language::getInstance()->getIdByCode($language);
//        }
//        return $language;
//    }
    
    public function getCountriesSpecial()
    {
        return $this->countriesSpecial;
    }
    
    public function getContent()
    {
        return $this->content;
    }
    
    public function getContentId($content)
    {
        if(array_key_exists($content, $this->content)) {
            return $this->content[$content];
        }
        return null;
    }
    
    public function getCatalogues()
    {
        return $this->catalogues;
    }
    
    public function getTerritoryId($code)
    {
        $code = strtoupper($code);
        if(array_key_exists($code, $this->catalogues)) {
            return $this->catalogues[$code];
        }
        return null;
    }
    
    public function getTerritoryCode($id)
    {
        $flipped = array_flip($this->catalogues);
        if(array_key_exists($id, $flipped)) {
            return $flipped[$id];
        }
        return null;
    }
    
    public function isContentSupported($content)
    {
        if($this->getContentCountry($content)) {
            return true;
        }
        return false;
    }
    
    public function getCountryId()
    {
        $userCountry = $this->DAO('model', 'users')->getUserCountry();
        
        $shopId = isset($this->countriesId[$userCountry]) ? $this->countriesId[$userCountry] : 0;
        if(empty($shopId)) {
            $shopId = 34;
        }
        return $shopId;
    }
    
    public function logIt($filename, $text)
    {
         file_put_contents(VAR_PATH . 'logs/' . $filename, $text, FILE_APPEND | LOCK_EX);
    }
    
    public function getPerPage()
    {
        if(is_null($this->session->perPage)) {
            $this->session->perPage = 50;
        }
        return $this->session->perPage;
    }
    
    public function getLettersContainer($content, $dbField = null)
    {
        $container = array(
            'current' => '',
            'sql' => '',
            'divisions' => array(),
            'letters' => $this->letters
        );
        
        // Store to session
        $sess = empty($this->session->letterCurrent) ? array() : $this->session->letterCurrent;
        foreach($this->content as $key => $val) {
            if(!isset($sess[$key])) {
                $sess[$key] = 'a';
            }
        }
        
        // Check request|session
        $req = $this->request->get('letter');
        if($req != '') {
            $current = $req;
        } else {
            $current = $this->request->get('type') == '' ? $sess[$content] : '';
        }
        
        // Check
        if($current != '') {
            if(strpos($current, '-') === false && in_array($current, $this->letters)) {
                $letter = $current;
            } elseif(preg_match('/^([a-z]{2}-([a-z]{2}))$/s', $current)) {
                $segments = explode('-', $current);
                $letter = substr($segments[0], 0, 1);
                $division = array(substr($segments[0], 1, 1), substr($segments[1], 1, 1));
                if($letter != substr($segments[1], 0, 1) || !in_array(implode('-', $division), $this->lettersDivisions)) {
                    $current = '';
                }
            } else {
                $current = '';
            }
        }
        
        // Process
        if($current != '') {
            $container['current'] = $current;
            $container['divisions'] = $this->getLetterDivisions($letter);
            $container['sql'] = $this->getLetterSql($letter, $dbField, (isset($division) ? $division : null));
            if($this->request->get('letter') == '') {
                $this->request->requestCurrent = $this->request->requestCurrent . '/letter/' . $current;
            }
            $sess[$content] = $current;
        }
        $this->session->letterCurrent = $sess;
        
        return $container;
    }
    
    public function getLetterDivisions($letter)
    {
        $divisions = array();
        if(!is_numeric($letter)) {
            foreach($this->lettersDivisions as $division) {
                $division = explode('-', $division);
                $division1 = $letter . $division[0];
                $division2 = $letter . $division[1];
                $divisions[$division1 . '-' . $division2] = strtoupper($division1 . ' - ' . $division2);
            }
        }
        return $divisions;
    }
    
    public function getLetterSql($letter, $dbField, $division)
    {
        if(!empty($letter) && !empty($dbField)) {
            if(empty($division)) {
                return " AND $dbField LIKE " . DB::quote($letter . '%');
            } else {
                $range = $division[0] . '-' . $division[1];
                return " AND $dbField REGEXP '^" . $letter . "[" . $range . "]'";
            }
        }
        return '';
    }
    
    public function getSortOrder($content)
    {
        $return = array(
            'list' => $this->sortOrders[$content],
            'current' => 0,
            'sql' => ''
        );
        
        $sessVar = 'sortOrder' . ucfirst($content);
        $sessVal = $this->session->{$sessVar};
        if($sessVal === null) {
            $this->session->{$sessVar} = $return['current'];
        } else {
            $return['current'] = $sessVal;
        }
        
        $return['sql'] = $this->sortOrders[$content][$return['current']]['field'] . ' ' . $this->sortOrders[$content][$return['current']]['direction'];
        if($return['current'] > 0) {
            $return['sql'] .= ', ' . $this->sortOrders[$content][0]['field'] . ' asc';
        }
                 
        return $return;
    }
    
    public function addObserver($observer, $args = null)
    {
        if(array_key_exists(self::$SHOP['abbreviation'], Settings::app()->observers)) {
            foreach(Settings::app()->observers[self::$SHOP['abbreviation']] as $name => $data) {
                if(strtolower($name) == strtolower($observer)) {
                    if(is_string($data)) {
                        $data = array('observer', $data);
                    }
                    $object = $this->DAO($data[0], $data[1]);
                    if($object instanceof Core_Model && method_exists($object, $name)) {
                        return $object->$name($args);
                    }
                }
            }
        }
    }
    
    public function isRequestFromMobileDevice()
    {
        return true;
        $device = Loader::load('Library_Wurfl')->manager()->getDeviceForHttpRequest($_SERVER);
        if($device->getCapability('is_wireless_device') == 'true' || $device->getCapability('is_tablet') == 'true') {
            return true;
        }
        return false;
    }

    public function getRealTerritory(){

        $catalogue = $this->DAO('model', 'users')->getUserCountry();
            return $this->catalogues[strtoupper($catalogue)];

        $sessCatalogue = $this->session->showCatalogue;
        if (!empty($sessCatalogue) && isset($this->catalogues[strtoupper($sessCatalogue)])) {
            return $this->catalogues[strtoupper($sessCatalogue)];
        }
        
    }
    public function isPlatformEnabled($contentType)
    {
        $setting = Library_Platforms::getSettings($contentType);
        
        // If setting is just true or false, return
        if ($setting === true || $setting === false){
            return $setting;
        }

        // If setting is allow all, return true
        if ($setting === Library_Platforms::ALL) {
            return true;
        }

        if (!$platformId = Library_Platforms::getPlatformId()) {
            return false;
        }

        $check = $platformId & $setting;
        if($check === (int)0){
            // Bit not found, not enabled for content type
            return false;
        }

        return true;
    }

    public function getContentTypeId($contentType){
        $result = DB::fetchOne('SELECT id FROM content_types WHERE name = ?', array(strtolower($contentType)));
        return $result;
    }

    public function getOrderId($content){
        if(!is_numeric($content)) $content = $this->getContentId($content);
        if(!isset($this->contentAbbr[$content])) throw new Exception('Cannot generate order ID without valid content type');
        $abbr = $this->contentAbbr[$content];

        $userId = $this->auth->getLogged('Id');
        if(!$userId) throw new Exception('Cannot generate order ID without user ID');

        $orderId = strtoupper($abbr) . $userId . time();
        return $orderId;
    }

    public function getThreatMetrixParams($content, $data){
        $geoIp = Loader::loadHelper('geoip');

        $params = array(
            'input_ip_address'=>$_SERVER['REMOTE_ADDR'],
            'account_login'=>$this->auth->getLogged('Id'),
            'account_email'=>$this->auth->getLogged('email__c'),
            'account_first_name'=>$this->auth->getLogged('name__c'),
            'account_last_name'=>$this->auth->getLogged('last_name__c'),
            'account_address_country'=>$this->auth->getLogged('geo_id__c'),
            'transaction_amount'=>isset($data['track']) ? number_format(round($data['track']['price']['transaction_price'], 2), 2) : number_format(round($data['price']['transaction_price'], 2), 2),
            'transaction_currency'=>isset($data['track']) ? $data['track']['price']['transaction_currency'] : $data['price']['transaction_currency'],
            'local_attrib_1'=>$data['order_id'],
            'local_attrib_2'=>(int)$this->content[$content] . '-' . $data['id'],
            'local_attrib_3'=>(int)$this->content[$content],
            'local_attrib_4'=>self::$SHOP['id'],
            'local_attrib_5'=>$this->auth->getLogged('external_user_id__c'),
            'local_attrib_6'=>$countryCode = $geoIp->geoip_country_code_by_addr($_SERVER['REMOTE_ADDR'])
        );

        foreach($params as $key => $param){
            if($param === false || $param === null || $param === '') unset($params[$key]);
        }

        return $params;
    }
}

?>