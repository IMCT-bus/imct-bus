declare namespace Resources {
  export type RouteResource = Models.Route & {
    stops: Resources.StopResource[];
  };

  export type StopResource = Models.Stop & { arrives_at: string | null; position: number };

  export type TripResource = Models.Trip & {
    remaining_seats: number;
    route: Resources.RouteResource;
  };
}
