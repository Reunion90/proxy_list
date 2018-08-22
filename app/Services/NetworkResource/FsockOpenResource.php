<?php
/**
 * Created by PhpStorm.
 * User: uman
 * Date: 22.08.18
 * Time: 16:31
 */

namespace App\Services\NetworkResource;


class FsockOpenResource implements NetworkResourceInterface
{
    private $timeout;
    private $fp;
    private $ip;
    private $port;

    public function __construct(int $timeout)
    {
        $this->timeout = $timeout;
    }

    public function open(string $ip, int $port): bool
    {
        $this->ip = $ip;
        $this->port = $port;
        $this->fp = @fsockopen($ip, $port, $errno, $errstr, $this->timeout);

        return $this->fp ? true : false;
    }

    public function check(): bool
    {
        if (!$this->fp) {
            return false;
        }
        @fwrite($this->fp, "HEAD / HTTP/1.0\r\nHost: $this->ip:$this->port\r\n\r\n");
        $readData = @fread($this->fp, 1024);
        $this->close();
        return (strlen($readData) > 0) ? true : false;
    }

    public function close()
    {
        fclose($this->fp);
    }
}