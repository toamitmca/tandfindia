<?php
/**
 * Distributor
 *
 * @filesource
 */
namespace TandF\India\Entity;

/**
 * Encapsulates a Distributor.
 *
 * @package    TandF\India\Entity\Distributor
 * @version    1.0.1
 * @copyright  2016 Taylor & Francis Group
 * @author     Sean Sciarrone <sean.sciarrone@taylorandfrancis.com>
 */

class Distributor extends Entity implements \JsonSerializable
{

    /**
     * Load methods used across Entities.
     */
    use EntityTrait;

    /**
     * Load Constructor method.
     */
    use EntityConstructTrait;

    /**
     * @var string Identifier (ISIS Code)
     */
    protected $id;

    /**
     * @var string Name
     */
    protected $name;

    /**
     * @var string|array Address
     */
    protected $address;

    /**
     * @var string City
     */
    protected $city;

    /**
     * @var string Region
     */
    protected $region;

    /**
     * @var string Post Code
     */
    protected $postCode;

    /**
     * @var string Country
     */
    protected $country;

    /**
     * @var string Contact
     */
    protected $contact;

    /**
     * @var string Phone Number(s)
     */
    protected $phone;

    /**
     * @var string Email address(es)
     */
    protected $email;

    /**
     * @var string Website(s)
     */
    protected $website;

    /**
     * @var bool Ecommerce support?
     */
    protected $ecommerce;

    /**
     * @var string apiUrl
     */
    protected $apiUrl;
	
    /**
     * Distributor Address for presentation
     *
	 * @param string $inrIsbn	INR ISBN from sheet
	 * @param string $isbn		IBSN13
     * @return string HTML
     */
    public function printDistributorAddress($inrIsbn, $isbn)
    {
        $str = '<address class="vcard">';
        $str .= '<p>';
        $str .= '<strong class="org">' . $this->name . '</strong>';
        if ( ! empty($this->address)) {
            $str .= '<br><span class="adr">';
            $str .= '<span class="street-address">' . $this->address . '</span>';
            if ( ! empty($this->city)) {
                $str .= '<br><span class="locality">' . $this->city . '</span>';
            }
            if ( ! empty($this->region)) {
                $str .= ', <span class="region">' . $this->region . '</span>';
            }
            if ( ! empty($this->postCode)) {
                $str .= ' <span class="postal-code">' . $this->postCode . '</span>';
            }
            if ( ! empty($this->country)) {
                $str .= ', <span class="country-name">' . $this->country . '</span>';
            }
            $str .= '</span>';
        }	
        if ( ! empty($this->apiUrl)) {
            $str .=$this->distributorApi($this->id, $this->apiUrl, $inrIsbn, $isbn);
        }		
        if ( ! empty($this->website) && empty($this->apiUrl)) {
            $str .= '<br><a href="' . $this->website . '" class="url">' . $this->website . '</a>';
        }
        if ( ! empty($this->contact)) {
            $str .= '<br>Contact: <span class="fn">' . $this->contact . '</span>';
        }
        if ( ! empty($this->email)) {
            $str .= '<br>Email: <a href="mailto:' . $this->email . '" class="email">' . $this->email . '</a>';
        }
        if ( ! empty($this->phone)) {
            $str .= '<br>Phone: <span class="tel">' . $this->phone . '</span>';
        }
        $str .= '</p>';
        $str .= '</address>';

        return $str;
    }
	
    /**
     * Distributor API 
	 * Manohar					:http://manoharbooks.com/BookDetails.asp?isbn=ISBN13 
	 * Star Books (Researchco)	:http://star-bk.com/product/ISBNTITLE 
	 * Atlantic Books			:https://www.atlanticbooks.com/ISBN	
	 *
     * @param string $distId  	(902M40-Manohar, 902S33-Star Books (Researchco), 902A21-Atlantic Books)
	 * @param string $apiUrl	API URL
	 * @param string $inrIsbn 	INR ISBN from sheet
	 * @param string $isbn	 	ISBN13
     * @return string HTML
     */	
	public function distributorApi($disId, $apiUrl, $inrIsbn, $isbn){
		$str = '';
		$linkIsbn = (!empty($inrIsbn)) ? $inrIsbn : $isbn;
		if($disId === '902M40'){	
			$str .= '<br><a href="' .str_replace('ISBN13',$linkIsbn,$apiUrl).'" target="_blank" class="btn btn-success">Buy</a>';
		}		
		if($disId === '902A21'){
			$str .= '<br><a href="' .str_replace('ISBN',$linkIsbn,$apiUrl).'" target="_blank" class="btn btn-success">Buy</a>';
		}		
		
		return $str;
	}
}