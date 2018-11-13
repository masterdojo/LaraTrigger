<?php

use Illuminate\Http\Request;

namespace Masterdojo\LaraTrigger;

class LaraTrigger
{
    private $text;
    private $type;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * @return string
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $message
     * @return LaraTrigger
     */
    public function info(string $message): LaraTrigger
    {
        $this->type = config('laratrigger.message_info');;
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @param string $message
     * @return LaraTrigger
     */
    public function success(string $message): LaraTrigger
    {
        $this->type = config('laratrigger.message_success');
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @param string $message
     * @return LaraTrigger
     */
    public function warning(string $message): LaraTrigger
    {
        $this->type = config('laratrigger.message_warning');
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @param string $message
     * @return LaraTrigger
     */
    public function error(string $message): LaraTrigger
    {
        $this->type = config('laratrigger.message_error');
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return "<div class='" . config('laratrigger.message_class') . " {$this->getType()}'>{$this->getText()}</div>";
    }

    /**
     * @return string
     */
    public function json(): string
    {
        return json_encode(["error" => $this->getText()]);
    }

    /**
     * Set flash Session Key
     */
    public function flash(): void
    {
        Request()->session()->flash('flash', $this);
    }

    /**
     * @param string $message
     * @return string
     */
    private function filter(string $message): string
    {
        return filter_var($message, FILTER_SANITIZE_STRIPPED);
    }
}