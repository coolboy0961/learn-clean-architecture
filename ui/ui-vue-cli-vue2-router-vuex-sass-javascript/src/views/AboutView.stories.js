import { userEvent, screen } from "@storybook/testing-library";
import { expect } from "@storybook/jest";

import AboutView from "./AboutView.vue";
import store from "@/store";

export default {
  title: "Component/AboutView",
  component: AboutView,
};

const Template = () => {
  store.dispatch("reset");
  return {
    components: { AboutView },
    template: "<AboutView />",
    store,
  };
};

export const Default = Template.bind({});
Default.play = async () => {
  // Arrange
  const expected = "count: 2";

  // Act
  const incrementButton = await screen.findByRole("button");

  await userEvent.click(incrementButton);
  await userEvent.click(incrementButton);

  const actual = await screen.findByText(expected);

  // Assert
  expect(actual).toBeInTheDocument();
};
