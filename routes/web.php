<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

/****Admin Login Route*****/
Route::get('admin_yetek224/login', ['as' => 'admin.login', 'uses' => 'Admin\Auth\LoginController@showLoginForm']);
Route::post('admin_yetek224/login', ['as' => 'admin.login', 'uses' => 'Admin\Auth\LoginController@login']);
Route::post('admin_yetek224/logout', ['as' => 'admin.logout', 'uses' => 'Admin\Auth\LoginController@logout']);

/****Admin vérification*****/
Route::get('admin_yetek224/admin/verification/{token}', ['as' => 'admin.verify', 'uses' => 'Admin\Auth\VerificationController@verifyAdmin']);

//admin pwrd reset
Route::get('admin_yetek224/password/reset', ['as' => 'admin.password.reset', 'uses' => 'Admin\Auth\ForgotPasswordController@emailForm']);
Route::post('admin_yetek224/password/send/reset_link', ['as' => 'admin.password.reset.link', 'uses' => 'Admin\Auth\ForgotPasswordController@sendLink']);
Route::get('admin_yetek224/password/reset_link/{token}', ['as' => 'admin.password.edit', 'uses' => 'Admin\Auth\ResetPasswordController@resetForm']);
Route::post('admin_yetek224/password/reset/save', ['as' => 'admin.password.reset.save', 'uses' => 'Admin\Auth\ResetPasswordController@passwordSave']);

// admins
Route::prefix('admin_yetec224')->namespace('Admin')->name('admin.')->group( function(){

    /****Admin Register Route*****/
    Route::resource('gestion_admin', 'ManageAdminController');

    /***  Region et Ville   ****/
    Route::get('/region_ville', ['as' => 'region.ville', 'uses' => 'RegionVilleController@regionVille']);
    Route::post('/region_create', ['as' => 'region.create', 'uses' => 'RegionVilleController@addRegion']);
    Route::delete('/region_delete/{id}', ['as' => 'region.delete' ,'uses' => 'RegionVilleController@deleteRegion']);
    Route::post('/ville_create', ['as' => 'ville.create' ,'uses' => 'RegionVilleController@addVille']);
    Route::delete('/ville_delete/{id}', ['as' => 'ville.delete' ,'uses' => 'RegionVilleController@deleteVille']);

    /***  Category   ****/
    Route::get('/category_item', ['as' => 'category.item' ,'uses' => 'CategoryController@category']);
    Route::post('/category_create', ['as' => 'category.create' ,'uses' => 'CategoryController@addCategory']);
    Route::delete('/category_delete/{id}', ['as' => 'category.delete' ,'uses' => 'CategoryController@deleteCategory']);
    Route::post('/category_item_create', ['as' => 'category.item.create' ,'uses' => 'CategoryController@addItem']);
    Route::delete('/category_item_delete/{id}', ['as' => 'category.item.delete' ,'uses' => 'CategoryController@deleteItem']);
    
    /***  Attribute   ****/
    Route::get('/category_attribute', ['as' => 'category.attribute' ,'uses' => 'CategoryController@attribute']);
    Route::post('/category_attribute_create', ['as' => 'attribute.create' ,'uses' => 'CategoryController@addAttribute']);
    Route::post('/category_attribute_associate', ['as' => 'attribute.associate' ,'uses' => 'CategoryController@associateAttribute']);
    // show subcat attrs
    Route::post('/show/each_category_attribute', 'CategoryController@showSubcatAttribute');

    /***  Option prix   ****/
    Route::get('/price_option', ['as' => 'price.option' ,'uses' => 'PriceOptionController@priceOption']);
    Route::post('/price_option', ['as' => 'price.option.create' ,'uses' => 'PriceOptionController@addPriceOption']);
    Route::delete('/price_option/{id}', ['as' => 'price.option.delete' ,'uses' => 'PriceOptionController@deletePriceOption']);
    
    /***  Manage ads   ****/
    Route::get('/annonces', ['as' => 'annonces' ,'uses' => 'ManageAdsController@index']);
    Route::post('/annonces/suspend', 'ManageAdsController@suspendAd');
    Route::post('/annonces/delete', 'ManageAdsController@deleteAd');
    Route::post('/annonces/validate', 'ManageAdsController@validateAd');

    /***  Manage comptes   ****/
    Route::get('/comptes', ['as' => 'comptes', 'uses' => 'ManageCompteController@index']);
    Route::post('/comptes/suspend', 'ManageCompteController@suspendCompte');
    Route::post('/comptes/delete/{compteid}', ['as' => 'compte.delete', 'uses' => 'ManageCompteController@deleteCompte']);

    Route::get('/', ['as' => 'home' ,'uses' => 'AdminController@index']);
});

/****Compte Login Route*****/
Route::post('compte/login', ['as' => 'compte.login', 'uses' => 'Auth\LoginController@login']);

// update account  
Route::post('compte/update', ['as' => 'compte.update', 'uses' => 'ManageCompteController@updateUser']);
// Change password
Route::post('password/change', ['as' => 'password.change', 'uses' => 'ManageCompteController@change']);

// Reset password
Route::get('password/restaurer/email', ['as' => 'password.restaurer.email', 'uses' => 'Auth\ForgotPasswordController@resetEmail']);
Route::post('password/send/link', ['as' => 'password.send.link', 'uses' => 'Auth\ForgotPasswordController@sendLink']);
Route::get('password/edit/{token}', ['as' => 'password.edit', 'uses' => 'Auth\ResetPasswordController@editPassword']);
Route::post('password/restaurer', ['as' => 'password.restaurer', 'uses' => 'Auth\ResetPasswordController@resetPassword']);

// user profile
Route::get('profile', ['as' => 'profile', 'uses' => 'HomeController@index']);
Route::get('profile/informations', ['as' => 'profile.information', 'uses' => 'HomeController@information']);
Route::get('profile/annonces', ['as' => 'profile.annonce', 'uses' => 'HomeController@annonce']);
Route::get('profile/favoris', ['as' => 'profile.favori', 'uses' => 'HomeController@favori']);
Route::get('profile/recherches', ['as' => 'profile.recherche', 'uses' => 'HomeController@recherche']);
Route::get('profile/messages', ['as' => 'profile.message', 'uses' => 'HomeController@message']);
// delete ad
Route::post('profile/ad/delete', 'HomeController@deleteAd');
// delete compte
Route::post('profile/compte/delete/{compte_id}', ['as' => 'compte.delete', 'uses' => 'HomeController@deleteCompte']);

// Accueil
Route::get('/', ['as' => 'index', 'uses' => 'PagesController@index']);
// A propos
Route::get('/g/a-propos', ['as' => 'about', 'uses' => 'PagesController@about']);
// Aide
Route::get('/g/aide', ['as' => 'aide', 'uses' => 'PagesController@aide']);
// Nous contacter
Route::get('/g/contact', ['as' => 'contact', 'uses' => 'PagesController@contact']);
Route::post('/g/contact/send', ['as' => 'contact.send', 'uses' => 'PagesController@contactSend']);
// Publicite
Route::get('/g/faire-une-publicite', ['as' => 'publicite', 'uses' => 'PagesController@publicite']);
// Condition d'utilisation
Route::get('/g/condition-utilisation', ['as' => 'use.term', 'uses' => 'PagesController@useTerm']);
// Politique de confidentialité
Route::get('/g/politique-confidentialite', ['as' => 'privacy.policy', 'uses' => 'PagesController@privacyPolicy']);

// Report ad
Route::get('/report-ad/{annonce_id}', ['as' => 'report.ad', 'uses' => 'PagesController@reportAd']);
Route::post('/report-ad', ['as' => 'report.ad.store', 'uses' => 'PagesController@reportAdStore']);

// message to seller
Route::post('/annonce/message/seller', ['as' => 'message.seller', 'uses' => 'PagesController@messageToSeller']);

// categories
Route::get('/guinee/annonces/{category}', ['as' => 'annonces.categorie', 'uses' => 'AdsByCatController@category']);

// new ad
Route::get('/nouvelle/annonce/{id}/success', ['as' => 'ad.added.success', 'uses' => 'ManageAdController@adAddedSuccess']);
Route::get('/nouvelle/annonce', ['as' => 'add.new.ad', 'uses' => 'ManageAdController@newAd']);
Route::post('/nouvelle/annonce-create', ['as' => 'new.ad.create', 'uses' => 'ManageAdController@createAd']);

// ad photos
Route::get('/annonce/photo/{token}', ['as' => 'ad.photo.form', 'uses' => 'ManagePhotoController@adPhotoForm']);
Route::post('/annonce/photo/create', 'ManagePhotoController@adPhotoCreate');
//['as' => 'ad.photo.create', 'uses' => /annonce/photo/create

// ad attributes 
Route::get('/annonce/attribute/{token}', ['as' => 'ad.attribute.form', 'uses' => 'ManageAdController@attributeAdForm']);
Route::post('/annonce/attribute/create', ['as' => 'ad.attribute.create', 'uses' => 'ManageAdController@attributeAdCreate']);

// update ad
Route::get('/modifier/annonce/{id}', ['as' => 'edit.ad', 'uses' => 'ManageAdController@editAd']);
Route::post('/modifier/annonce-update', ['as' => 'update.ad', 'uses' => 'ManageAdController@updateAd']);
// update photos
Route::get('/modifier/photos/annonce/{id}', ['as' => 'edit.photo.ad', 'uses' => 'ManagePhotoController@editPhotos']);
Route::post('/modifier/photos/annonce-update', ['as' => 'update.photo.ad', 'uses' => 'ManagePhotoController@updatePhotos']);

// sponsor ad
Route::get('/sponsor/annonce/{id}', ['as' => 'sponsor.ad.form', 'uses' => 'ManageAdController@sponsorAdForm']);
Route::post('/sponsor/annonce', ['as' => 'sponsor.ad.store', 'uses' => 'ManageAdController@sponsorAdStore']);

//list ads type offre demand
Route::get('guinee/annonce-offre', ['as' => 'annonce.type.offre', 'uses' => 'ListAdsController@offre']);
Route::get('guinee/annonce-demande', ['as' => 'annonce.type.demande', 'uses' => 'ListAdsController@demande']);

// boutiques
Route::get('/annuaires-boutiques', ['as' => 'boutique.list', 'uses' => 'ListBoutiqueController@listBoutique']);
Route::get('/annuaires-boutiques/{brand}', ['as' => 'boutique.detail', 'uses' => 'ListBoutiqueController@detailBoutique']);

// search ads
Route::get('recherche/annonces', ['as' => 'ads.search', 'uses' => 'SearchAdsController@search']);

// Ad detail
Route::get('annonces/{ville}/{category}/{slug}', ['as' => 'ad.detail', 'uses' => 'ListAdsController@adDetail']);

// favouriting ad
Route::post('/annonce/favourite/add', 'FavouriteAdController@add');
Route::post('/annonce/favourite/delete', 'FavouriteAdController@delete');
Route::post('annonce/favourite/remove', ['as' => 'annonce.favourite.remove', 'uses' => 'FavouriteAdController@removeFavori']);

//list ads region
Route::get('annonces/{region}', ['as' => 'annonces.region', 'uses' => 'AdsByRegController@region']);

// verifier email compte
Route::get('/compte/verification/{token}', 'Auth\VerificationController@verifyCompte');


// clear cache
Route::get('/yetek24/clear-cache', function() {
	Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('clear-compiled');
    Artisan::call('config:cache');
    return 'View cache cleared';
});

// php version
Route::get('/yetek24/php-version', function() {
    
    echo phpinfo();
});