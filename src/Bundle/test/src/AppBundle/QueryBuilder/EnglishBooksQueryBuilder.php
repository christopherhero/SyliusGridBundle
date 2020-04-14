<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace AppBundle\QueryBuilder;

use AppBundle\Entity\Author;
use AppBundle\Repository\BookRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

final class EnglishBooksQueryBuilder
{
    /** @var BookRepository */
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function create(): QueryBuilder
    {
        return $this->bookRepository->createQueryBuilder('b')
            ->innerJoin(Author::class, 'author', Join::WITH, 'author.id = b.author')
            ->innerJoin('author.nationality', 'na')
            ->andWhere('na.name = :nationality')
            ->setParameter(':nationality', 'English')
        ;
    }
}