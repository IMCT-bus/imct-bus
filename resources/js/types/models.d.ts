declare namespace Models {
  export type Stop = {
    id: number | string;
    name: string;
    link: string | null;
  };

  export type Route = {
    id: number;
    name: string;
    starts_at: string;
  };

  export type RouteStop = {
    id: number;
    route_id: number;
    stop_id: number;
    arrives_at: string;
    position: number;

    route?: Models.Route;
    stop?: Models.Stop;
  };

  export type Trip = {
    uuid: string;
    date: string;
    is_published: boolean;
    car_number: string;
    link: string | null;
    seats: number;
    route_id: number;
  };
}
