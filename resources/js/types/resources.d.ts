declare namespace Resources {
  export type RouteResource = Models.Route & {
    stops: Resources.StopResource[];
  };

  export type StopResource = Models.Stop & { arrives_at: string | null; position: number };
}
