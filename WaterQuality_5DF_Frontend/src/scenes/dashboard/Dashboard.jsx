import { useMediaQuery } from "react-responsive";
import Row1 from "./Row1";
import Row2 from "./Row2";
import Row3 from "./Row3";

const gridTemplateLargeScreens = `
  "a b c"
  "a b c"
  "a b c"
  "a b f"
  "d e f"
  "d e f"
  "d h i"
  "g h i"
  "g h j"
  "g h j"
`;

const gridTemplateSmallScreens = `
  "a"
  "a"
  "a"
  "a"
  "b"
  "b"
  "b"
  "b"
  "c"
  "c"
  "d"
  "d"
  "d"
  "e"
  "e"
  "f"
  "f"
  "g"
  "g"
  "g"
  "h"
  "h"
  "h"
  "h"
  "i"
  "i"
  "j"
  "j"
`;

const Dashboard = () => {
  const isAboveMediumScreens = useMediaQuery({ minWidth: 1200 });

  return (
    <div
      className={`w-full h-full grid gap-6 px-6 pb-6 ${
        isAboveMediumScreens
          ? "grid-cols-[repeat(3,_minmax(370px,_1fr))] grid-rows-[repeat(10,_minmax(60px,_1fr))]"
          : "grid-cols-1 auto-rows-[80px]"
      }`}
      style={{
        gridTemplateAreas: isAboveMediumScreens
          ? gridTemplateLargeScreens
          : gridTemplateSmallScreens,
      }}
    >
      <Row1 />
      <Row2 />
      <Row3 />
    </div>
  );
};

export default Dashboard;
