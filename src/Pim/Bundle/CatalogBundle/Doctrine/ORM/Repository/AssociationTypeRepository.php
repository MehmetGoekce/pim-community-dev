<?php

namespace Pim\Bundle\CatalogBundle\Doctrine\ORM\Repository;

use Doctrine\ORM\EntityRepository;
use Pim\Component\Catalog\Model\EntityWithAssociationsInterface;
use Pim\Component\Catalog\Repository\AssociationTypeRepositoryInterface;

/**
 * Association repository
 *
 * @author    Gildas Quemener <gildas@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class AssociationTypeRepository extends EntityRepository implements AssociationTypeRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findMissingAssociationTypes(EntityWithAssociationsInterface $entity)
    {
        $qb = $this->createQueryBuilder('a');

        if ($associations = $entity->getAssociations()) {
            $associationTypeIds = $associations->map(
                function ($association) {
                    return $association->getAssociationType()->getId();
                }
            );

            if (!$associationTypeIds->isEmpty()) {
                $qb->andWhere(
                    $qb->expr()->notIn('a.id', $associationTypeIds->toArray())
                );
            }
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function countAll(): int
    {
        $qb = $this->createQueryBuilder('a')
            ->select('count(a.id)');

        return (int) $qb
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByIdentifier($code)
    {
        return $this->findOneBy(['code' => $code]);
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifierProperties()
    {
        return ['code'];
    }
}
