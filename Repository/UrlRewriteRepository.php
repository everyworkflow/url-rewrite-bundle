<?php

/**
 * @copyright EveryWorkflow. All rights reserved.
 */

declare(strict_types=1);

namespace EveryWorkflow\UrlRewriteBundle\Repository;

use EveryWorkflow\CoreBundle\Annotation\RepoDocument;
use EveryWorkflow\MongoBundle\Repository\BaseDocumentRepository;
use EveryWorkflow\UrlRewriteBundle\Document\UrlRewriteDocument;
use EveryWorkflow\UrlRewriteBundle\Document\UrlRewriteDocumentInterface;

/**
 * @RepoDocument(doc_name=UrlRewriteDocument::class)
 */
class UrlRewriteRepository extends BaseDocumentRepository implements UrlRewriteRepositoryInterface
{
    protected string $collectionName = 'url_rewrite_collection';
    protected array $indexNames = ['url'];

    protected function validateSingle(UrlRewriteDocumentInterface $urlRewriteDocument): void
    {
        if (!$urlRewriteDocument->getUrl()) {
            throw new \Exception('UrlRewrite must have url.');
        }
    }

    //    /**
    //     * @return \MongoDB\UpdateResult
    //     */
    //    public function save(UrlRewriteDocumentInterface $urlRewriteDocument, array $otherFilter = [], array $otherOptions = [])
    //    {
    //        $this->validateSingle($urlRewriteDocument);
    //        return $this->saveByField('url', $urlRewriteDocument, $otherFilter, $otherOptions);
    //    }

    /**
     * @return array|object|null
     */
    public function deleteByUrl(string $url, array $otherFilter = [])
    {
        return $this->deleteByFilter(array_merge(['url' => $url], $otherFilter));
    }

    /**
     * @return UrlRewriteDocumentInterface[]
     */
    public function find(array $filter = [], array $options = []): array
    {
        $items = [];
        $mongoData = $this->getCollection()->find($filter, $options);
        /** @var \MongoDB\Model\BSONDocument $mongoItem */
        foreach ($mongoData as $mongoItem) {
            $items[] = $this->getDocumentFactory()->create(UrlRewriteDocument::class, $mongoItem->getArrayCopy());
        }
        return $items;
    }

    public function findOne(array $filter = [], array $options = []): UrlRewriteDocumentInterface
    {
        $mongoItem = $this->getCollection()->findOne($filter, $options);
        if (!$mongoItem) {
            throw new \Exception('Document not found under ' . $this->collectionName);
        }
        return $this->getDocumentFactory()->create(UrlRewriteDocument::class, $mongoItem->getArrayCopy());
    }
}
