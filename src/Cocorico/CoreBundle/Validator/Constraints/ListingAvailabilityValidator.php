<?php

/*
 * This file is part of the Cocorico package.
 *
 * (c) Cocolabs SAS <contact@cocolabs.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cocorico\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ListingAvailabilityValidator extends ConstraintValidator
{

    private $minPrice;

    /**
     * @param int $minPrice
     */
    public function __construct($minPrice)
    {
        $this->minPrice = $minPrice;
    }

    /**
     * @param mixed      $listingAvailability
     * @param Constraint $constraint
     */
    public function validate($listingAvailability, Constraint $constraint)
    {
        /** @var $listingAvailability \Cocorico\CoreBundle\Document\ListingAvailability */
        //Price

        if ($listingAvailability->getPrice() < $this->minPrice) {
            $this->context->buildViolation($constraint::$messageMinPrice)
                ->atPath('price')
                ->setParameter('{{ min_price }}', $this->minPrice / 100)
                ->setTranslationDomain('cocorico_listing')
                ->addViolation();
        }
    }

}
