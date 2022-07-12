<?php

namespace Ipresso\Domain;

class ContactSource
{
    private ?string $utmCampaign = null;
    private ?string $utmContent = null;
    private ?string $utmMedium = null;
    private ?string $utmSource = null;
    private ?string $utmTerm = null;

    public function hasValue(): bool{
        return  $this->utmCampaign !== null || $this->utmContent !== null || $this->utmMedium !== null || $this->utmSource !== null || $this->utmTerm !==  null;
    }

    public function getUtmCampaign(): ?string
    {
        return $this->utmCampaign;
    }

    public function setUtmCampaign(?string $utmCampaign): ContactSource
    {
        $this->utmCampaign = $utmCampaign;
        return $this;
    }


    public function getUtmContent(): ?string
    {
        return $this->utmContent;
    }

    public function setUtmContent(?string $utmContent): ContactSource
    {
        $this->utmContent = $utmContent;
        return $this;
    }

    public function getUtmMedium(): ?string
    {
        return $this->utmMedium;
    }

    public function setUtmMedium(?string $utmMedium): ContactSource
    {
        $this->utmMedium = $utmMedium;
        return $this;
    }

    public function getUtmSource(): ?string
    {
        return $this->utmSource;
    }

    public function setUtmSource(?string $utmSource): ContactSource
    {
        $this->utmSource = $utmSource;
        return $this;
    }

    public function getUtmTerm(): ?string
    {
        return $this->utmTerm;
    }

    public function setUtmTerm(?string $utmTerm): ContactSource
    {
        $this->utmTerm = $utmTerm;
        return $this;
    }


}