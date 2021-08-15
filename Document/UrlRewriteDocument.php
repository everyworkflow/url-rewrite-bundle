<?php

/**
 * @copyright EveryWorkflow. All rights reserved.
 */

declare(strict_types=1);

namespace EveryWorkflow\UrlRewriteBundle\Document;

use EveryWorkflow\CoreBundle\Annotation\EWFDataTypes;
use EveryWorkflow\MongoBundle\Document\BaseDocument;
use EveryWorkflow\MongoBundle\Document\HelperTrait\CreatedUpdatedHelperTrait;
use EveryWorkflow\MongoBundle\Document\HelperTrait\StatusHelperTrait;

class UrlRewriteDocument extends BaseDocument implements UrlRewriteDocumentInterface
{
    use CreatedUpdatedHelperTrait;
    use StatusHelperTrait;

    /**
     * @param string $url
     * @return $this
     * @EWFDataTypes (type="string", mongofield=self::KEY_URL, required=TRUE, minLength=3, maxLength=50)
     */
    public function setUrl(string $url): self
    {
        $this->dataObject->setData(self::KEY_URL, $url);
        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->dataObject->getData(self::KEY_URL);
    }

    /**
     * @param string $type
     * @return $this
     * @EWFDataTypes (type="string", mongofield=self::KEY_TYPE, required=TRUE)
     */
    public function setType(string $type): self
    {
        $this->dataObject->setData(self::KEY_TYPE, $type);
        return $this;
    }

    public function getType(): ?string
    {
        return $this->dataObject->getData(self::KEY_TYPE);
    }

    /**
     * @param string $typeKey
     * @return $this
     * @EWFDataTypes (type="string", mongofield=self::KEY_TYPE_KEY, required=TRUE)
     */
    public function setTypeKey(string $typeKey): self
    {
        $this->dataObject->setData(self::KEY_TYPE_KEY, $typeKey);
        return $this;
    }

    public function getTypeKey(): ?string
    {
        return $this->dataObject->getData(self::KEY_TYPE_KEY);
    }
}
