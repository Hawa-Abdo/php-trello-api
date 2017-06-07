<?php

namespace Trello\Api\Card;

use Trello\Api\AbstractApi;
use Trello\Exception\InvalidArgumentException;

/**
 * Trello Card Labels API
 * @link https://trello.com/docs/api/card
 *
 * Fully implemented.
 */
class Labels extends AbstractApi
{
    protected $path = 'cards/#id#/labels';

    /**
     * Get labels related to a given card
     * @link https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink
     *
     * @param string $id     the card's
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function all($id, array $params = array('fields' => 'labels'))
    {
        return $this->get('cards/'.rawurlencode($id), $params)['labels'];
    }

    /**
     * Add a label to a given card
     * @link https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-labels
     *
     * @param string $id       the card's id or short link
     * @param array  $params   the label attributes
     *
     * @return array
     */
    public function add($id, array $params = array())
    {
        $this->validateRequiredParameters(array('color'), $params);

        return $this->post($this->getPath($id), $params);
    }

    /**
     * Remove a given label from a given card
     * @link https://trello.com/docs/api/card/#delete-1-cards-card-id-or-shortlink-labels-color
     *
     * @param string $id    the card's id or short link
     * @param string $label the label to remove
     *
     * @return array card info
     *
     * @throws InvalidArgumentException If a label does not exist
     */
    public function remove($id, $label)
    {
        $labels = array_map(function(array $label){
            return $label['color'];
        }, $this->all($id));

        if (!in_array($label, $labels)) {
            throw new InvalidArgumentException(sprintf('Label "%s" does not exist.', $label));
        }

        return $this->delete($this->getPath($id).'/'.rawurlencode($label));
    }
}
