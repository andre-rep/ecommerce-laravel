<header>
    <header-component
        asset-main="{{asset('/')}}"
        asset-logo="{{asset('storage/image/logo.png')}}"
        asset-profile="{{asset('/user/edit-profile')}}"
        asset-product-list="{{asset('/dashboard/product-list')}}"
        asset-auth="{{asset('/auth')}}"
        asset-cart="{{asset('user/cart')}}"
        auth-user="{{Auth::user()}}"
        user-name="{{Auth::user() ? Auth::user()->name : ''}}"
        user-access-level="{{Auth::user() ? Auth::user()->user_access_level : ''}}"
        cart-items="{{ $cartItems ?? '' }}"
    >
    </header-component>
</header>