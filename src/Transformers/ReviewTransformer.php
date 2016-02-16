<?php

namespace LukeRodham\TrustPilot\Transformers;

class ReviewTransformer
{
    /**
     * @var
     */
    private $review;
    /**
     * @var
     */
    private $companyReply;
    /**
     * @var
     */
    private $createdAt;
    /**
     * @var
     */
    private $reviewLink;
    /**
     * @var
     */
    private $rating;

    /**
     * @return mixed
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * @param mixed $review
     */
    public function setReview($review)
    {
        $this->review = $review;
    }

    /**
     * @return mixed
     */
    public function getCompanyReply()
    {
        return $this->companyReply;
    }

    /**
     * @param mixed $companyReply
     */
    public function setCompanyReply($companyReply)
    {
        $this->companyReply = $companyReply;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getReviewLink()
    {
        return $this->reviewLink;
    }

    /**
     * @param mixed $reviewLink
     */
    public function setReviewLink($reviewLink)
    {
        $this->reviewLink = $reviewLink;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @param array $reviews
     *
     * @return array
     */
    public function transformArray(array $reviews)
    {
        $transformedData = [];

        foreach ($reviews['reviews'] as $review) {

            $transformedData[] = $this->transform($review);
        }

        return $transformedData;
    }

    /**
     * @param $review
     *
     * @return ReviewTransformer
     */
    public function transform($review)
    {
        $reviewObj = new self;
        $reviewObj->setReview($review['text']);
        $reviewObj->setCompanyReply($review['companyReply']['text']);
        $reviewObj->setRating($review['stars']);
        $reviewObj->setCreatedAt($review['createdAt']);

        return $reviewObj;
    }
}