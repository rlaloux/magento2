<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Sales\Api;

/**
 * Credit memo add comment interface.
 *
 * After a customer places and pays for an order and an invoice has been issued, the merchant can create a credit memo
 * to refund all or part of the amount paid for any returned or undelivered items. The memo restores funds to the
 * customer account so that the customer can make future purchases.
 */
interface CreditmemoManagementInterface
{
    /**
     * Cancels a specified credit memo.
     *
     * @param int $id The credit memo ID.
     * @return bool
     */
    public function cancel($id);

    /**
     * Lists comments for a specified credit memo.
     *
     * @param int $id The credit memo ID.
     * @return \Magento\Sales\Api\Data\CreditmemoCommentSearchResultInterface Credit memo comment search results interface.
     */
    public function getCommentsList($id);

    /**
     * Emails a user a specified credit memo.
     *
     * @param int $id The credit memo ID.
     * @return bool
     */
    public function notify($id);
}
