import {IProduct} from '../product/product';

export interface ICategory {
  id: number;
  slug: string;
  name: string;
  products: IProduct[];
}
