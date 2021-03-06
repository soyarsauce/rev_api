<?php

namespace RevAPI;

class Order
{
    const ORDER_STATUS_COMPLETE = 'Complete';

    const ORDER_TYPE_TRANSCRIPTION = 'transcription';
    const ORDER_TYPE_CAPTION       = 'caption';
    const ORDER_TYPE_TRANSLATION   = 'translation';
    
    /**
     * @var Rev
     */
    protected $rev;

    /**
     * @var array
     */
    protected $order_data;
    
    public function __construct(Rev $rev, $order_data)
    {
        $this->rev = $rev;
        $this->order_data = $order_data;
    }

    /**
     * Get the order number
     * 
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->order_data['order_number'];
    }

    /**
     * Get the client reference of this order
     * 
     * @return string
     */
    public function getClientReference()
    {
        return $this->order_data['client_ref'];
    }

    /**
     * Get the status of this order
     * 
     * @return string
     */
    public function getStatus()
    {
        return $this->order_data['status'];
    }

    /**
     * Get attachments for this order
     * 
     * @return Attachments
     */
    public function getAttachments()
    {
        return new Attachments($this->rev, $this->order_data['attachments']);
    }

    /**
     * Get the raw order data
     * 
     * @return array
     */
    public function getOrderData()
    {
        return $this->order_data;
    }

    /**
     * Determine if this order is complete
     * 
     * @return bool
     */
    public function isComplete()
    {
        return $this->getStatus() == self::ORDER_STATUS_COMPLETE;
    }

    /**
     * Get the type of order
     * 
     * @return string
     */
    public function getOrderType()
    {
        if (array_key_exists(self::ORDER_TYPE_CAPTION, $this->order_data)) {
            return self::ORDER_TYPE_CAPTION;
        }

        if (array_key_exists(self::ORDER_TYPE_TRANSCRIPTION, $this->order_data)) {
            return self::ORDER_TYPE_TRANSCRIPTION;
        }
        
        return self::ORDER_TYPE_TRANSLATION;
    }
}
