<?php

namespace App;

use App\Vote;
use Auth;

trait Voteable
{

    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }

    public function checkIfVoted(User $user)
    {
        /**
         * function to check if user already voted
         *
         * @param User
         * @return boolean
         */

        return $this->votes()->where('user_id', $user->id)->exists();
    }

    public function getVote(User $user)
    {
        /**
         * function to get user's old vote
         *
         * @param User
         * @return Vote
         */

        return $this->votes()->where('user_id', $user->id)->first();
    }

    public function getPointsAttribute()
    {
        /**
         * function to get all points by Sum UPvotes and Subtract DOWNvotes
         *
         * @return int
         */

        $points = 0;
        foreach ($this->votes as $vote) {
            if ($vote->type == 'UP') {
                $points = $points + 1;
            } 
            elseif ($vote->type == 'DOWN') {
                $points = $points - 1;
            }
        }
        return $points;
    }

    public function vote(string $vote_type)
    {
        /**
         * function to submit or change user's vote
         * 
         * @param string
         * @return boolean
         */

         // check if user logged in
        if (Auth::user() != null) {
            $user = Auth::user();

            // if user not already voted add a new vote to database
            if (!$this->checkIfVoted($user)) {
                $vote = new Vote();
                $vote->user_id = Auth::user()->id;
                $vote->type = $vote_type;
                $this->votes()->save($vote);
                return true;
            }
            // if user already voted, change the old vote 
            else {
                $vote = $this->getVote($user);
                $vote->type = $vote_type;
                $vote->save();
                return true;
            }
        }
        return false;
    }
}
