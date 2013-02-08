<?php

namespace Nanaweb\MyFormBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class AddressTransformer implements DataTransformerInterface
{
    
    private $separator;
    private $nameForCityAddress;
    private $nameForExtraAddress;
    
    public function __construct($nameForCityAddress, $nameForExtraAddress, $separator = '  ')
    {
        $this->nameForCityAddress = $nameForCityAddress;
        $this->nameForExtraAddress = $nameForExtraAddress;
        $this->separator = $separator;
    }
    
    public function transform($address)
    {
        $cityAddress = '';
        $extraAddress = '';
        if (false !== strpos($address, $this->separator))
        {
          list($cityAddress, $extraAddress) = explode($this->separator, $address);
        }
        
        $addresses = array();
        $addresses[$this->nameForCityAddress] = $cityAddress;
        $addresses[$this->nameForExtraAddress] = $extraAddress;
        
        return $addresses;
    }

    public function reverseTransform($addresses)
    {
        foreach ($addresses as $key => $address)
        {
            $addresses[$key] = str_replace($this->separator, '', $address);
        }
        
        return $addresses[$this->nameForCityAddress].$this->separator.$addresses[$this->nameForExtraAddress];
    }
}