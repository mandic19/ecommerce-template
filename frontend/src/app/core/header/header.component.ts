import {Component, Input, OnInit} from '@angular/core';
import {ICategory} from '../../category/category';
import {Subscription} from "rxjs";
import {CartService} from "../../cart/services/cart.service";
import {ICart} from "../../cart/cart";
import {environment} from "../../../environments/environment";

@Component({
  selector: 'ecm-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})

export class HeaderComponent implements OnInit{
  @Input() categories: ICategory[] = [];
  cartTotal: number = 0;
  appName: string = environment.appName;

  private cartSub: Subscription;

  constructor(private cartService: CartService) {
    this.cartSub = this.cartService.getUpdate().subscribe(cart => this.setCartTotal(cart));
  }

  ngOnInit(): void {
    this.setCartTotal(this.cartService.getCart());
  }

  setCartTotal(cart: ICart): void {
    this.cartTotal = cart.total;
  }
}
