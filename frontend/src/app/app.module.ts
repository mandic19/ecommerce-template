import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {AppComponent} from './app.component';
import {HeaderComponent} from './core/header/header.component';
import {FooterComponent} from './core/footer/footer.component';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import {CategoryCardComponent} from './category/card/category-card.component';
import {ProductCardComponent} from './product/card/product-card.component';
import {RouterModule} from '@angular/router';
import {PageNotFoundComponent} from './core/page-not-found/page-not-found.component';
import {ReactiveFormsModule} from '@angular/forms';
import {ShopComponent} from './shop/shop.component';
import {CartComponent} from './cart/cart.component';
import {CurrencyPipe} from './shared/pipes/currency/currency.pipe';

// import ngx-translate and the http loader
import {TranslateLoader, TranslateModule} from '@ngx-translate/core';
import {TranslateHttpLoader} from '@ngx-translate/http-loader';
import {HttpClient, HttpClientModule} from '@angular/common/http';


@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    ShopComponent,
    CategoryCardComponent,
    ProductCardComponent,
    CartComponent,
    PageNotFoundComponent,
    CurrencyPipe
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    BrowserAnimationsModule,
    ReactiveFormsModule,
    TranslateModule.forRoot({
      loader: {
        provide: TranslateLoader,
        useFactory: HttpLoaderFactory,
        deps: [HttpClient]
      }
    }),
    RouterModule.forRoot([
      {path: '', component: ShopComponent},
      {path: '**', component: PageNotFoundComponent}
    ]),
  ],
  providers: [],
  bootstrap: [AppComponent]
})

export class AppModule {
}

// required for AOT compilation
export function HttpLoaderFactory(http: HttpClient): TranslateHttpLoader {
  return new TranslateHttpLoader(http);
}
