import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {AppComponent} from './app.component';
import {HeaderComponent} from './core/header/header.component';
import {FooterComponent} from './core/footer/footer.component';
import {HttpClientModule} from '@angular/common/http';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import {CategoryCardComponent} from './category/card/category-card.component';
import {ProductCardComponent} from './product/card/product-card.component';
import {RouterModule} from '@angular/router';
import {PageNotFoundComponent} from './core/page-not-found/page-not-found.component';
import {ReactiveFormsModule} from '@angular/forms';
import {ShopComponent} from './shop/shop.component';
import {CartComponent} from './cart/cart.component';
import { CurrencyPipe } from './shared/pipes/currency/currency.pipe';


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
        RouterModule.forRoot([
            {path: '', component: ShopComponent},
            {path: '**', component: PageNotFoundComponent}
        ]),
        ReactiveFormsModule
    ],
  providers: [],
  bootstrap: [AppComponent]
})

export class AppModule {
}
