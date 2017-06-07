<?php

namespace Trello\Api;

use Trello\Exception\InvalidArgumentException;

/**
 * Trello Card API
 * @link https://trello.com/docs/api/label
 */
class Label extends AbstractApi
{
    /**
     * Base path of cards api
     * @var string
     */
    protected $path = 'labels';

    /**
     * Label fields
     * @link https://trello.com/docs/api/label/#get-1-labels-label-id-field
     * @var array
     */
    public static $fields = array(
        'color',
        'idBoard',
        'name',
        'uses',
    );

    /**
     * Find a label by id
     * @link https://trello.com/docs/api/label/#get-1-labels-label-id
     *
     * @param string $id     the labels's id
     * @param array  $params optional attributes
     *
     * @return array label info
     */
    public function show($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Create a label
     * @link https://trello.com/docs/api/label/#post-1-labels
     *
     * @param array  $params optional attributes
     *
     * @return array label info
     */
    public function create(array $params = array())
    {
        $this->validateRequiredParameters(array('idBoard', 'name', 'color'), $params);

        return $this->post($this->getPath(), $params);
    }

    /**
     * Update a label
     * @link https://trello.com/docs/api/label/#put-1-labels-label-id
     *
     * @param string $id     the label's id
     * @param array  $params label attributes to update
     *
     * @return array label info
     */
    public function update($id, array $params = array())
    {
        return $this->put($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Set a given card's board
     * @link https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-idboard
     *
     * @param string $id      the card's id or short link
     * @param string $boardId the board's id
     *
     * @return array board info
     */
    public function setBoard($id, $boardId)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/idBoard', array('value' => $boardId));
    }

    /**
     * Get a given label's board
     * @link https://trello.com/docs/api/label/#get-1-labels-label-id-board
     *
     * @param string $id     the label's id
     * @param array  $params optional parameters
     *
     * @return array board info
     */
    public function getBoard($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/board', $params);
    }

    /**
     * Get the field of a board of a given label
     * @link https://trello.com/docs/api/label/#get-1-labels-label-id-board-field
     *
     * @param string $id    the label's id
     * @param array  $field the name of the field
     *
     * @return array board info
     *
     * @throws InvalidArgumentException if the field does not exist
     */
    public function getBoardField($id, $field)
    {
        $this->validateAllowedParameters(Board::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/board/'.rawurlencode($field));
    }

    /**
     * Set a given label's name
     * @link https://trello.com/docs/api/label/#get-1-labels-label-id-name
     *
     * @param string $id   the label's id
     * @param string $name the name
     *
     * @return array label info
     */
    public function setName($id, $name)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/name', array('value' => $name));
    }

    /**
     * Set a given label's color
     * @link https://trello.com/docs/api/label/#get-1-labels-label-id-color
     *
     * @param string $id          the label's id
     * @param string $color the color
     *
     * @return array label info
     */
    public function setColor($id, $color)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/color', array('value' => $color));
    }
}
