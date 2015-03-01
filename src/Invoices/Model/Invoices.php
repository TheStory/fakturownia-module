<?php

namespace Invoices\Model;

use Invoices\Interfaces;

class Invoices implements Interfaces\GpInvoices
{

    private $sFLogin;
    private $sFPassword;
    private $sFHost;
    private $sFToken;

    public function __construct($oSC)
    {

        //$em = $oSC->get('Doctrine\ORM\EntityManager');
        $aConf = $oSC->get('config');

        //$findedById = $em->find($aConf['invoices_entity'], 1);

        $this->sFLogin = $aConf['fakturownia']['login'];
        $this->sFPassword = $aConf['fakturownia']['password'];
        $this->sFHost = $aConf['fakturownia']['host'];
        $this->sFToken = $aConf['fakturownia']['token'];

        // is cURL installed
        if (!function_exists('curl_init')) {
            die('Sorry cURL is not installed!');
        }
    }

    /**
     * @get all invoice by user id
     * @param int $iUserId
     */
    public function getInvoicesByUserId($iUserId)
    {
        $sUrl = 'https://' . $this->sFHost . '/invoices.json?client_id=' . $iUserId . '&api_token=' . $this->sFToken;
        return $this->__connect($sUrl);
    }

    private function __connect($sUrl, $sParams = null)
    {
        $c = curl_init();

        // set URL and other appropriate options
        curl_setopt($c, CURLOPT_URL, $sUrl);

        if (!empty($sParams)) {

            $head[] = 'Accept: application/json';
            $head[] = 'Content-Type: application/json';

            curl_setopt($c, CURLOPT_HTTPHEADER, $head);
            curl_setopt($c, CURLOPT_POSTFIELDS, $sParams);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);


        } else {
            curl_setopt($c, CURLOPT_HEADER, 0);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        }

        $sRes = curl_exec($c);
        $res = json_decode($sRes);
        curl_close($c);

        $aRes = $this->__objectToArray($res);

        return $aRes;
    }

    /**
     * This method convert array of object to array or object to array
     * @param object or array $res
     * @return array
     */
    private function __objectToArray($res)
    {
        $aRes = array();
        if (is_array($res) && !empty($res)) {
            foreach ($res as $array) {
                $aRes[] = get_object_vars($array);
            }
        } else if (is_object($res)) {
            $aRes = (array)$res;
        }
        return $aRes;
    }

    /*
     * @desc get all invoices
    */

    public function getAllInvoices()
    {
        $sUrl = 'https://' . $this->sFHost . '/invoices.json?api_token=' . $this->sFToken;
        return $this->__connect($sUrl);
    }

    /**
     * @desc get invoice by id
     * @param int $iInvoiceId
     */
    public function getInvoiceById($iInvoiceId)
    {
        $sUrl = 'https://' . $this->sFHost . '/invoices/' . $iInvoiceId . '.json?api_token=' . $this->sFToken;
        return $this->__connect($sUrl);
    }

    public function getCurrentMonthInvoices()
    {
        $sUrl = 'https://' . $this->sFHost . '/invoices.json?period=this_month&api_token=' . $this->sFToken;
        return $this->__connect($sUrl);
    }

    public function newInvoice()
    {

    }


    public function saveNewInvoice($sData)
    {
        $json = '{ "api_token": "' . $this->sFToken . '", "invoice": ' . $sData . ' }';
        $sUrl = 'https://' . $this->sFHost . '/invoices.json';

        $aRes = $this->__connect($sUrl, $json);

        if (isset($aRes['error'])) {

        } else {
            //add new client into
        }
    }

    public function getClientList()
    {
        $sUrl = 'https://' . $this->sFHost . '/clients.json?api_token=' . $this->sFToken;
        return $this->__connect($sUrl);
    }

    public function getClientById($iClientId)
    {
        $sUrl = 'https://' . $this->sFHost . '/clients/' . $iClientId . '.json?api_token=' . $this->sFToken;
        return $this->__connect($sUrl);
    }

    public function editClientById($iClientId)
    {
        //...
        //$sUrl = 'https://'. $this->sFHost .'/clients.json/?api_token=' . $this->sFToken;
    }

}