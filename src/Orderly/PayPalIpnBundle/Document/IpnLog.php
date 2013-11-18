<?php
namespace Orderly\PayPalIpnBundle\Document;

use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert,
    Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/*
 * Copyright 2012 Orderly Ltd
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */


/**
 * Orderly\PayPalIpnBundle\Document\IpnLog
 *
 * @MongoDB\Document(collection="ipn_log")
 */
class IpnLog
{
    /**
     * @var string $id
     *
     * @MongoDB\Id(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $listenerName
     *
     * @MongoDB\Field(name="listener_name", type="string")
     * @Assert\Length(max = "3")
     */
    private $listenerName;

    /**
     * @var string $transactionType
     *
     * @MongoDB\Field(name="transaction_type", type="string")
     * @Assert\Length(max = "16")
     */
    private $transactionType;

    /**
     * @var string $transactionId
     *
     * @MongoDB\Field(name="transaction_id", type="string")
     * @Assert\Length(max = "19")
     */
    private $transactionId;

    /**
     * @var string $status
     *
     * @MongoDB\Field(name="status", type="string")
     * @Assert\Length(max = "16")
     */
    private $status;

    /**
     * @var string $message
     *
     * @MongoDB\Field(name="message", type="string")
     * @Assert\Length(max = "512")
     */
    private $message;

    /**
     * @var string $ipnDataHash
     *
     * @MongoDB\Field(name="ipn_data_hash", type="string")
     * @Assert\Length(max = "32")
     */
    private $ipnDataHash;

    /**
     * @var text $detail
     *
     * @MongoDB\Field(name="detail", type="string")
     */
    private $detail;

    /**
     * @var datetime $createdAt
     *
     * @MongoDB\Field(name="created_at", type="date")
     * @Assert\NotBlank()
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     *
     * @MongoDB\Field(name="updated_at", type="date", nullable=false)
     * @Assert\NotBlank()
     */
    private $updatedAt;



    /**
     * Set id
     *
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = trim($id);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set listenerName
     *
     * @param string $listenerName
     */
    public function setListenerName($listenerName)
    {
        $this->listenerName = $listenerName;
    }

    /**
     * Get listenerName
     *
     * @return string
     */
    public function getListenerName()
    {
        return $this->listenerName;
    }

    /**
     * Set transactionType
     *
     * @param string $transactionType
     */
    public function setTransactionType($transactionType)
    {
        $this->transactionType = $transactionType;
    }

    /**
     * Get transactionType
     *
     * @return string
     */
    public function getTransactionType()
    {
        return $this->transactionType;
    }

    /**
     * Set transactionId
     *
     * @param string $transactionId
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * Get transactionId
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * Set status
     *
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set message
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set ipnDataHash
     *
     * @param string $ipnDataHash
     */
    public function setIpnDataHash($ipnDataHash)
    {
        $this->ipnDataHash = $ipnDataHash;
    }

    /**
     * Get ipnDataHash
     *
     * @return string
     */
    public function getIpnDataHash()
    {
        return $this->ipnDataHash;
    }

    /**
     * Set detail
     *
     * @param text $detail
     */
    public function setDetail($detail)
    {
        if(!$this->isUtf8($detail)){
            $detail = $this->setToUtf8($detail);
        }
        $this->detail = $detail;
    }

    /**
     * Get detail
     *
     * @return text
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * PrePersist createdAt
     *
     * @MongoDB\PrePersist
     */
    public function setCreatedAtValue(\DateTime $createdAt = null)
    {
        if($createdAt==null && $this->createdAt == null){
            $this->createdAt = new \DateTime();
        }else if($createdAt instanceof \DateTime){
            $this->createdAt = $createdAt;
        }
    }

    /**
     * Set updatedAt
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return datetime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * PrePersist and PreUpdate UpdatedAt-Value
     *
     * @MongoDB\PreUpdate
     * @MongoDB\PrePersist
     */
    public function setUpdatedAtValue(\DateTime $updatedAt = null)
    {
        if($updatedAt==null && $this->updatedAt == null){
            $this->updatedAt = new \DateTime();
        }else if($updatedAt instanceof \DateTime){
            $this->updatedAt = $updatedAt;
        }else{
            $this->updatedAt = new \DateTime();
        }
    }
    private function isUtf8($string) {
        // From http://w3.org/International/questions/qa-forms-utf-8.html
        return preg_match('%^(?:
              [\x09\x0A\x0D\x20-\x7E]            # ASCII
            | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
            |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
            | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
            |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
            |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
            | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
            |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
        )*$%xs', $string);
    }   

    private function setToUtf8($string) { 
        return iconv(mb_detect_encoding($string, mb_detect_order(), true), "UTF-8", $string);
    }
    
}