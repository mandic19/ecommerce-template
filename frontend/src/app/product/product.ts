import {IProductVariant} from './product-variant/product-variant';

export interface IProduct {
  id: number;
  category_id: number;
  name: string;
  sku: string;
  price: number;
  short_description: string;
  variants: IProductVariant[];
}
