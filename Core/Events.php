<?php

namespace GingerPayments\Core;

class Events
{

    /**
     * Execute action on activate event.
     *
     * @return void
     */
    public static function onActivate()
    {
        self::addGingerpaymentsPaymentMethods();
    }

    /**
     * Adds ginger payment methods
     *
     */
    public static function addGingerpaymentsPaymentMethods()
    {
        $aPayments = [
                'gingerpaymentscreditcard'     => [ 'OXID'          => 'gingerpaymentscreditcard',
                'OXDESC_DE'     => 'Kreditkarte',
                'OXDESC_EN'     => 'Credit Card',
                'OXLONGDESC_DE' => 'Der Betrag wird von Ihrer Kreditkarte abgebucht, sobald die Bestellung abgeschickt wird',
                'OXLONGDESC_EN' => 'The amount will be debited from your credit card once the order is submitted'
            ],
            'gingerpaymentssepa'           => [ 'OXID'          => 'gingerpaymentssepa',
                'OXDESC_DE'     => 'Lastschrift SEPA',
                'OXDESC_EN'     => 'Direct Debit SEPA',
                'OXLONGDESC_DE' => 'Ihr Konto wird nach Abschicken der Bestellung belastet',
                'OXLONGDESC_EN' => 'Your account will be debited upon the order submission'
            ]
        ];
        $oLangArray = \OxidEsales\Eshop\Core\Registry::getLang()->getLanguageArray();
        $oPayment = oxNew(\OxidEsales\Eshop\Application\Model\Payment::class);
        foreach ($oLangArray as $oLang) {
            foreach ($aPayments as $aPayment) {
                $oPayment->setId($aPayment['OXID']);
                $oPayment->setLanguage($oLang->id);
                $sLangAbbr = in_array($oLang->abbr, ['de', 'en']) ? $oLang->abbr : 'en';
                $oPayment->oxpayments__oxid          = new \OxidEsales\Eshop\Core\Field($aPayment['OXID']);
                $oPayment->oxpayments__oxaddsumrules = new \OxidEsales\Eshop\Core\Field('31');
                $oPayment->oxpayments__oxtoamount    = new \OxidEsales\Eshop\Core\Field('1000000');
                $oPayment->oxpayments__oxtspaymentid = new \OxidEsales\Eshop\Core\Field('');
                $oPayment->oxpayments__oxdesc     = new \OxidEsales\Eshop\Core\Field($aPayment['OXDESC_'. strtoupper($sLangAbbr)]);
                $oPayment->oxpayments__oxlongdesc = new \OxidEsales\Eshop\Core\Field($aPayment['OXLONGDESC_'. strtoupper($sLangAbbr)]);
                $oPayment->save();
            }
        }
        unset($oPayment);
    }
}