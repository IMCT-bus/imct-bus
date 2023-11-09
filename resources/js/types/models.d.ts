declare namespace Models {
  export type Stop = {
    id: number | string;
    name: string;
    link: string | null;
  }

  export type Route = {
    id: string;
    name: string;
    starts_at: string;
  }

  export type RouteStop = {
    id: number;
    route_id: number;
    stop_id: number;
    arrives_at: string;

    route?: Models.Route;
    stop?: Models.Stop;
  }
}