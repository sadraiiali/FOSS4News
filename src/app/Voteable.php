<?php

namespace App;

use App\Vote;
use Illuminate\Support\Facades\Auth;

trait Voteable
{

    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }

    /**
     * function to check if user already voted
     *
     * @param User
     * @return boolean
     */
    public function checkIfVoted(User $user)
    {
        return $this->votes()->where('user_id', $user->id)->exists();
    }

    /**
     * function to get user's old vote
     *
     * @param User
     * @return Vote
     */
    public function getVote(User $user)
    {
        return $this->votes()->where('user_id', $user->id)->first();
    }

    /**
     * function to get all points by Sum UpVotes and Subtract DownVotes
     *
     * @return int
     */
    public function getPointsAttribute()
    {
        $points = 0;
        foreach ($this->votes as $vote) {
            if ($vote->type == 'UP') {
                $points = $points + 1;
            } elseif ($vote->type == 'DOWN') {
                $points = $points - 1;
            }
        }
        return $points;
    }

    /**
     * function to submit or change user's vote
     *
     * @param string can be 0 or DOWN or 1 or UP
     * @return boolean
     */
    public function vote(string $vote_type)
    {
        if (!($vote_type == 'UP' || $vote_type == '1' ||
            $vote_type == 'DOWN' || $vote_type == '0')) {
            return false;
        }

        if (Auth::user() != null) {
            $user = Auth::user();

            if (!$this->checkIfVoted($user)) {
                $this->votes()->create([
                    'user_id' => Auth::user()->id,
                    'type' => $vote_type
                ]);

            } else {
                $vote = $this->getVote($user);
                if ($vote->type != $vote_type) {
                    $vote->type = $vote_type;
                    $vote->save();
                }
            }

            if ($vote_type == 'UP' || $vote_type == '1') {
                $this->increment('likes');
            } else if ($vote_type == 'DOWN' || $vote_type == '0') {
                $this->increment('dislikes');
            }

            return true;
        }
        return false;
    }
}
