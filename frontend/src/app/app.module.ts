import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {AppComponent} from './app.component';
import {HeaderComponent} from "./core/header/header.component";
import {FooterComponent} from "./core/footer/footer.component";
import {HttpClientModule} from "@angular/common/http";
import {BrowserAnimationsModule} from "@angular/platform-browser/animations";
import {CarouselModule} from "ngx-owl-carousel-o";
import {HomeComponent} from "./core/home/home.component";
import {CategoryCardComponent} from "./category/card/category-card.component";
import {ProductCardComponent} from "./product/card/product-card.component";
import {RouterModule} from "@angular/router";
import {PageNotFoundComponent} from './core/page-not-found/page-not-found.component';
import {LoginComponent} from "./core/login/login.component";
import {ReactiveFormsModule} from "@angular/forms";

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    HomeComponent,
    LoginComponent,
    CategoryCardComponent,
    ProductCardComponent,
    PageNotFoundComponent
  ],
    imports: [
        BrowserModule,
        HttpClientModule,
        BrowserAnimationsModule,
        CarouselModule,
        RouterModule.forRoot([
            {path: '', component: HomeComponent},
            {path: '**', component: PageNotFoundComponent}
        ]),
        ReactiveFormsModule
    ],
  providers: [],
  bootstrap: [AppComponent]
})

export class AppModule {
}
