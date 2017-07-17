<?php

namespace Project;

use Aura\Session\SessionFactory;

class Session
{
    private static $instance;

    /**
     * @var \Aura\Session\Session
     */
    protected $session;

    private function __construct($cookieValues)
    {
        $this->session = (new SessionFactory())->newInstance($cookieValues);
        $this->segment = $this->session->getSegment(static::class);
    }

    /**
     * Gives you an instance of the session.
     *
     * @return static
     */
    public static function getInstance()
    {
        if ( ! self::$instance) {
            self::$instance = new static($_COOKIE);
        }

        return self::$instance;
    }

    /**
     * Flash a message for the next request.
     *
     * @param $message
     * @param $type
     *
     * @return $this
     */
    public function flashMessage($message, $type)
    {
        $this->segment->setFlash('message', $message);
        $this->segment->setFlash('message_type', $type);

        return $this;
    }

    /**
     * Get flashed message.
     */
    public function getFlashedMessage()
    {
        return [
            'message' => $this->segment->getFlash('message'),
            'message_type' => $this->segment->getFlash('message_type'),
        ];
    }

    /**
     * Set a value in the client's session.
     *
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function set($key, $value)
    {
        $this->segment->set($key, $value);

        return $this;
    }

    /**
     * Get a value from the client's session.
     *
     * @param $key
     * @param $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->segment->get($key, $default);
    }
}
