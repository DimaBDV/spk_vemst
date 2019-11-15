<?php

namespace App\Policies;

use App\Offer;
use App\User;
use http\Env\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferPolicy
{
    use HandlesAuthorization;

    /**
     * @param \App\User  $user
     * @param $ability
     * @return bool
     */
    public function before($user, $ability)
    {
        if ( $user->isAdmin() ) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any offers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the offer.
     *
     * @param  \App\User  $user
     * @param  \App\Offer  $offer
     * @return mixed
     */
    public function view(User $user, Offer $offer)
    {
        return $user->id === $offer->user_id;
    }

    /**
     * Determine whether the user can create offers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isActive();
    }

    /**
     * Determine whether the user can update the offer.
     *
     * @param  \App\User  $user
     * @param  \App\Offer  $offer
     * @return mixed
     */
    public function update(User $user, Offer $offer)
    {
        return $user->id === $offer->user_id
            ? Response::allow()
            : Response::deny('Сожалеем но мы не можем вам этого позволить, не вы создали этот запрос');;
    }

    /**
     * Determine whether the user can delete the offer.
     *
     * @param  \App\User  $user
     * @param  \App\Offer  $offer
     * @return mixed
     */
    public function delete(User $user, Offer $offer)
    {
        return $user->id === $offer->user_id
            ? Response::allow()
            : Response::deny('Сожалеем но мы не можем вам этого позволить, не вы создали этот запрос');;
    }

    /**
     * Determine whether the user can restore the offer.
     *
     * @param  \App\User  $user
     * @param  \App\Offer  $offer
     * @return mixed
     */
    public function restore(User $user, Offer $offer)
    {
        return $user->id === $offer->user_id
            ? Response::allow()
            : Response::deny('Сожалеем но мы не можем вам этого позволить, не вы создали этот запрос');
    }

    /**
     * Determine whether the user can permanently delete the offer.
     *
     * @param  \App\User  $user
     * @param  \App\Offer  $offer
     * @return mixed
     */
    public function forceDelete(User $user, Offer $offer)
    {
        return false;
    }
}
